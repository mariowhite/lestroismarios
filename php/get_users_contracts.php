<?php
/**
 * Created by PhpStorm.
 * User: Mario A. Blanco
 * Date: 2016-02-01
 * Time: 10:20 AM
 */

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
if (mysqli_connect_errno($con)) {
    echo $fail . mysqli_connect_error();
    mysqli_close($con);
} else {

    $contract = $_POST['contract'];

    $querysql = "SELECT username FROM users_contracts WHERE id_name_contract = '" . $contract . "'";
    $result = mysqli_query($con, $querysql) or die('Error: ' . mysqli_error($con));

    $temp = array();
    while ($data = mysqli_fetch_array($result)) {
        array_push($temp, $data['username']);
    }

    echo json_encode($temp);

    mysqli_close($con);
}