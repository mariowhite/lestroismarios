<?php
/**
 * Created by PhpStorm.
 * User: Mario A. Blanco
 * Date: 2016-02-08
 * Time: 12:09 PM
 */



include 'url.php';
include 'database.php';

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


$idcomplaint = $_GET["idc"];
$idphoto = $_GET["idf"];


$target_dir = "../photos/";
$target_file = $idcomplaint."/".$idphoto;


//delete from database
$con=mysqli_connect($host,$user,$password,$database);

// Check connection
if (mysqli_connect_errno())
{
    echo $fail . mysqli_connect_error();
}
else
{

    $sql = "DELETE FROM photo WHERE id = '".$idcomplaint."' AND filename = '".$idphoto."'";
    $result = mysqli_query($con,$sql) or die($msg5);

    if(mysqli_affected_rows($result))
        unlink($target_dir . $target_file); //delete from file
    else
        echo $msg6;

    mysqli_close($con);

    header($base_url . 'php/forum.php');
}



?>