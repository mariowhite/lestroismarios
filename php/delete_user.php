<?php
include "database.php";
include "url.php";

session_start();
if (!isset($_SESSION['user']))
    header("Location: customer.php");

if (isset($_COOKIE["language"])) {
    if ($_COOKIE["language"] == "fr")
        include("fr.php");
    else
        include("en.php");
} else
    include("en.php");

//get user name to be deleted from database
$username = $_GET["user"];

//connect to database and check info
$con = mysqli_connect($host, $user, $password, $database);


// Check connection
if (mysqli_connect_errno($con)) {
    echo $fail . mysqli_connect_error();
} else {

    $query = "DELETE FROM users WHERE username = '" . $username . "'";

    mysqli_query($con, $query);
    mysqli_close($con);

    header($base_url . 'php/edit_user.php?msg=' . urlencode($msg3));


}

?>
