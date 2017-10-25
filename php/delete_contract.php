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
$name = $_GET["name"];

//connect to database and check info
$con = mysqli_connect($host, $user, $password, $database);


// Check connection
if (mysqli_connect_errno($con)) {
    echo $fail . mysqli_connect_error();
} else {

    $query = "DELETE FROM contracts WHERE id_name = '$name'";

    mysqli_query($con, $query);
    mysqli_close($con);

    header($base_url . 'php/edit_contract.php?msg=' . urlencode($msg_delete_contract));


}

?>
