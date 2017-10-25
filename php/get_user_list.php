<?php
/**
 * Created by PhpStorm.
 * User: Mario A. Blanco
 * Date: 2016-02-01
 * Time: 11:27 AM
 */


if (!isset($_SESSION['user']))
    header("Location: customer.php");

include 'database.php';

//connect to database and check info
$con = mysqli_connect($host, $user, $password, $database);


// Check connection
if (mysqli_connect_errno($con)) {
    echo $fail . mysqli_connect_error();
} else {
    $query = "SELECT * FROM users";
    $result = mysqli_query($con, $query);


    if (mysqli_num_rows($result)) {

        echo "<table class='altrowstable' id='alternatecolor' style='width: 410px; margin-left: 101px;float: left;margin-top: 20px;'>";
        echo "<tr>";
        echo "<th style = 'width:40px;'>".$option."</th>";
        echo "<th>".$completename."</th>";
        echo "<th>".$user_type."</th>";
        echo "</tr>";

        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td><a href=''><img class='checker' style='width:25px; heigth:25px;' src='../images/unselect2.png' alt='" . $row['username'] . "' title='".$select."'></a></td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['type'] . "</td>";

            echo "</tr>";
        }

        echo "</table>";
    }
}

mysqli_close($con);


?>
