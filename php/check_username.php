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

//take values from method POST (user name and password)
$username = $_POST["username"];


//connect to database and check info
$con = mysqli_connect($host, $user, $password, $database);


// Check connection
if (mysqli_connect_errno())
{
    echo $fail . mysqli_connect_error();
}
else
{


    $sql = "SELECT * FROM users WHERE username = '".$username."'";
    $result = mysqli_query($con,$sql);

    if (mysqli_num_rows($result) > 0)
        echo('<img src="../images/not-available.png" style="width: 26px; height: 26px; padding-left: 10px; padding-bottom: 2px;" title="'.$in_use.'." />');
    else
        echo('<img src="../images/available.png" style="width: 26px; height: 26px; padding-left: 10px; padding-bottom: 2px;" title="'.$available.'." />');


}

mysqli_close($con);



?>