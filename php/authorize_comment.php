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
            $type = $_POST['type'];
            $action = $_POST['action'];

            if($action == "Authorize")
            {
                $sql = "INSERT INTO users_autorized (id_complaint, usertype) VALUES (".$id.", '".$type."')";
                mysqli_query($con,"SET FOREIGN_KEY_CHECKS=0");
                    mysqli_query($con,$sql) or die($fail . mysqli_error($con));
                mysqli_query($con,"SET FOREIGN_KEY_CHECKS=1");
            }
            else
            {
                $sql = "DELETE FROM users_autorized WHERE id_complaint = ".$id." AND usertype = '".$type."'";
                mysqli_query($con,"SET FOREIGN_KEY_CHECKS=0");
                    mysqli_query($con,$sql) or die($fail . mysqli_error($con));
                mysqli_query($con,"SET FOREIGN_KEY_CHECKS=1");


            }


        mysqli_close($con);

        //header($base_url . 'php/forum.php');
    }
}


?>