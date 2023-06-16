<?php
$car = array(
    array("Car name", "No of car", "No of car sold"),
    array("Maruti", 10, 5),
    array("Volvo", 10, 3),
    array("Honda", 20, 12)

);
$count1 = sizeof($car);
$count2 = sizeof($car[0]);
?>
<table>
    <?php
    for ($i = 0; $i < $count1; $i++) {
        ?>
        <tr>
            <?php
            for ($j = 0; $j < $count2; $j++) {
                ?>
                <td>
                    <?php
                    echo $car[$i][$j];
                    ?>
                </td>
                <?php
            }
            ?>
        </tr>
        <?php
    }
    ?>
</table>


<?php
    // echo "Hello this is a cookies part";
    // setcookie("catagory", "study", time() + 60, "/");
?>