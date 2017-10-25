<?php

if (!isset($_SESSION['user']))
    header("Location: customer.php");

if(isset($_COOKIE["language"]))
{
    if($_COOKIE["language"]=="fr")
        include("fr.php");
    else
        include("en.php");
}
else
    include("en.php");

include 'database.php';
include 'url.php';

//show uploaded photos
$id = $_GET["idcomplaint"];

//connect to database and get photos

$con = mysqli_connect($host,$user,$password,$database);

// Check connection
if (mysqli_connect_errno($con))
{
    echo $fail . mysqli_connect_error();
}
else
{
    $query = "SELECT * FROM photo WHERE id='".$id."'";

    $result = mysqli_query($con,$query);

    if(mysqli_num_rows($result)) {
        echo"<h2 style='padding:20px 0 0 0;'>".$preview.": </h2>";
        echo "<div class='wrapper pad_bot1 marg_top1'>";

        while ($row = mysqli_fetch_array($result)) {
            echo "<div class='img'>";
                echo "<img style='margin-top:0;' class='photo' src='../photos/" . $id . "/" . $row['filename'] . "' alt='' title='".$row['description']."'>";
                //echo "<div class='desc'>".$row['description']."</div>";
            echo "</div>";

        }

        echo "</div>";
    }

}





?>