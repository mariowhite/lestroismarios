<?php
/**
 * Created by PhpStorm.
 * User: Mario A. Blanco
 * Date: 2016-01-22
 * Time: 12:29 PM
 */

session_start();
if (!isset($_SESSION['user']))
    header("Location: customer.php");

include 'database.php';
include 'url.php';

if(isset($_COOKIE["language"]))
{
    if($_COOKIE["language"]=="fr")
        include("fr.php");
    else
        include("en.php");
}
else
    include("en.php");

$con = mysqli_connect($host, $user, $password, $database);

// Check connection
if (mysqli_connect_errno($con))
{
    echo $fail . mysqli_connect_error();
    mysqli_close($con);
}
else {

    $name = $_POST['name'];

    $querysql = "select * from contracts where id_name = '".$name."'";

    $result = mysqli_query($con, $querysql) or die('Error: ' . mysqli_error($con));

    $qty = mysqli_num_rows($result);

    if(mysqli_num_rows($result))
        echo "false";
    else
        echo "true";

    mysqli_close($con);
}
