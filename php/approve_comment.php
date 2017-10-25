<?php
/**
 * Created by PhpStorm.
 * User: Mario A. Blanco
 * Date: 2016-02-10
 * Time: 5:36 PM
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

session_start();
if (!isset($_SESSION['user']))
    header("Location: customer.php");

$type = $_SESSION['type'];

if($type == 'Director') {

    $con=mysqli_connect($host,$user,$password,$database);

    if (mysqli_connect_errno()) {
        echo $fail . mysqli_connect_error();
    }
    else {

        $id = $_POST['id']; //id of the complaint or reply to be authorized
        $value = $_POST['value'];

        $sql = "UPDATE complaints SET approve = ".$value." WHERE id_complaint = '".$id."'";
        $result = mysqli_query($con,$sql);

        //check if the id provided was found in the complaint table, if not check in the reply table
        if(mysqli_affected_rows($con) == 0)
        {
            $sql = "UPDATE reply SET approve = ".$value." WHERE id_reply = '".$id."'";
            $result = mysqli_query($con,$sql);

        }


        mysqli_close($con);

        //header($base_url . 'php/forum.php');
    }
}


?>