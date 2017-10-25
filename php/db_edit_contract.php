<?php
include 'database.php';
include 'url.php';

session_start();
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

$con = mysqli_connect($host,$user,$password,$database);

// Check connection
if (mysqli_connect_errno($con))
{
    echo $fail . mysqli_connect_error();
}
else
{

    $sql = "UPDATE contracts SET id_name = '$_POST[name]' WHERE id_name = '$_POST[id_name]'";

    if (!mysqli_query($con,$sql))
    {
        die('Error: ' . mysqli_error($con));
    }

    mysqli_close($con);

}





?>