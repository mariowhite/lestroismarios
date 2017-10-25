<?php

session_start();
if (!isset($_SESSION['user']))
    header("Location: customer.php");

include 'database.php';
include 'url.php';

$active_user = $_SESSION['user'];

$actual_date = date("Y-m-d H:i:s");
$complaintId = $_GET['complaint'];

$con=mysqli_connect($host,$user,$password,$database);

// Check connection
if (mysqli_connect_errno($con))
{
    echo $fail . mysqli_connect_error();
}
else
{
    $message = mysqli_real_escape_string($con,$_POST['message']);
    //$subject = mysqli_real_escape_string($con,$_POST['subject']);

    //try to find id_complaint in complaint and uodate text according to the new message received
    $sql = "UPDATE complaints SET text = '".$message."' WHERE id_complaint = ".$complaintId;
    $result = mysqli_query($con, $sql) or die("Error: " . mysqli_errno($con));

    //if no rows where affected try in reply table
    if(!mysqli_num_rows($result))
    {
        $sql2 = "UPDATE reply SET text = '".$message."' WHERE id_reply = ".$complaintId;
        $result = mysqli_query($con, $sql2) or die("Error: " . mysqli_errno($con));

    }



    mysqli_close($con);

}


header( $base_url. 'php/forum.php');

?>
