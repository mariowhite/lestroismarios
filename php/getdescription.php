<?php
include 'database.php';
include 'url.php';

if (isset($_COOKIE["language"])) {
    if ($_COOKIE["language"] == "fr")
        include("fr.php");
    else
        include("en.php");
} else
    include("en.php");

$con = mysqli_connect($host, $user, $password, $database);

// Check connection
if (mysqli_connect_errno($con)) {
    echo $fail . mysqli_connect_error();
} else {

    $id = $_POST['id'];
    $photo = $_POST['photo'];


    $query = "select * from photo where id=".$id." and filename='".$photo."'";
    $result = mysqli_query($con, $query) or die("Error");

    $row = mysqli_fetch_array($result);
    echo $row['description'];
}

?>