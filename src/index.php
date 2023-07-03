<?php
$locationData = array(
    "q1" => array(
        "kolkata" => array(
            "milk" => 340,
            "egg" => 604,
            "bread" => 38
        ),
        "delhi" => array(
            "milk" => 335,
            "egg" => 365,
            "bread" => 35
        ),
        "mumbai" => array(
            "milk" => 336,
            "egg" => 484,
            "bread" => 80
        )
    ),
    "q2" => array(
        "kolkata" => array(
            "milk" => 680,
            "egg" => 583,
            "bread" => 10
        ),
        "delhi" => array(
            "milk" => 684,
            "egg" => 490,
            "bread" => 48
        ),
        "mumbai" => array(
            "milk" => 595,
            "egg" => 594,
            "bread" => 39
        )
    ),
    "q3" => array(
        "kolkata" => array(
            "milk" => 535,
            "egg" => 490,
            "bread" => 50
        ),
        "delhi" => array(
            "milk" => 389,
            "egg" => 385,
            "bread" => 15
        ),
        "mumbai" => array(
            "milk" => 366,
            "egg" => 385,
            "bread" => 20
        )
    )
);
// code for displaying the data in tabular form
displayData($locationData);
function displayData($locationData)
{
    // generating table header dynamically
    echo "<table><thead><tr> <th rowspan='3'>Time</th>";
    foreach ($locationData as $locationKey => $locationValue) {
        foreach ($locationValue as $quarter => $quarterValue) {
            echo " <th colspan='3'>Location =$quarter</th>";
        }
        break;
    }
    echo "</tr><tr>";
    foreach ($locationValue as $quarter => $quarterValue) {
        echo " <th colspan='3'>item</th>";
    }
    echo "</tr><tr>";
    foreach ($locationValue as $quarter => $quarterValue) {
        foreach ($quarterValue as $key => $value) {
            echo "<th>$key</th>";
        }
    }
    echo "</tr>";
    echo "</thead><tbody>";
    //filling the values in table
    foreach ($locationData as $locationKey => $locationValue) {
        echo "<tr><td>$locationKey</td>";
        foreach ($locationValue as $quarter => $quarterValue) {
            foreach ($quarterValue as $key => $value) {
                echo "<td>$value</td>";
            }
        }
        echo "</tr>";
    }
    echo `</tbody></table>`;
}
//code for calculating the max egg sale
$maxEgg = 0;
$egg = 0;
$maxQtr = null;
foreach ($locationData as $locationKey => $locationValue) {
    $egg = 0;
    foreach ($locationValue as $quarter => $quarterValue) {
        foreach ($quarterValue as $key => $value) {
            if ($key == "egg") {
                $egg += $value;
            }
        }
        if ($maxEgg < $egg) {
            $maxEgg = $egg;
            $maxQtr = $locationKey;
        }
    }
}
echo "The Maximum sale of egg in <b>" . $maxQtr . "</b> quarter<br><br>";
$milk = minLocation($locationData, "milk");
$loc = array_keys($milk)[0];
echo "The minimum consumption of milk in <b>$loc</b> loction<br>";
echo "<br>";
// code for calculating the min sale location
function minLocation($locationData, $param)
{
    $minMilk = array();
    $i = 0;
    foreach ($locationData as  $locationValue) {
        foreach ($locationValue as $quarter => $quarterValue) {
            foreach ($quarterValue as $key => $value) {
                if ($key == $param) {
                    for ($i = 0; $i < 3; $i++) {
                        if (isset($minMilk[$i][$quarter])) {
                            $minMilk[$i][$quarter] += $value;
                            break;
                        }
                    }
                    if ($i == 3) {
                        array_push($minMilk, [$quarter => $value]);
                    }
                }
            }
        }
    }
    asort($minMilk);
    return $minMilk[0];
}
// delete location with minimum sale of bread
$bread = minLocation($locationData, "bread");
$loc = array_keys($bread)[0];
foreach ($locationData as $locationKey => $locationValue) {
    $count = 0;
    foreach ($locationValue as $quarter => $quarterValue) {
        if ($quarter == $loc) {
            array_splice($locationData[$locationKey], $count, 1);
        }
        $count++;
    }
}
//calling the function to display the data
displayData($locationData);
echo "<br><br>Displaying the table after delete the minimum sale of bread location<br><br>";
?>
<!-- style for table -->
<style>
    table {
        border-collapse: collapse;
    }

    td,
    th {
        border: 1px solid cyan;
        padding: 5px;
    }
</style>