<?php
/**
 * Created by PhpStorm.
 * User: Mario A. Blanco
 * Date: 2016-01-22
 * Time: 12:29 PM
 */

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

$con = mysqli_connect($host, $user, $password, $database);

// Check connection
if (mysqli_connect_errno($con)) {
    echo $fail . mysqli_connect_error();
    mysqli_close($con);
} else {

    $contract = $_POST['contract'];
    $users = $_POST['users'];

    //delete all rows where id_name_contract = contract
    $delete = "DELETE FROM users_contracts WHERE id_name_contract = '" . $contract . "'";
    mysqli_query($con, $delete) or die('Error: ' . mysqli_error($con));

    //save formations
    foreach ($users as $user) {

        $querysql = "INSERT INTO users_contracts (id_name_contract, username) VALUES ('$contract', '$user')";
        mysqli_query($con, $querysql) or die('Error: ' . mysqli_error($con));


    }

    echo $connect_result;

    mysqli_close($con);
}
