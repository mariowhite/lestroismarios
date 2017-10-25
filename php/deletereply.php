<?php

//TODO
//delete deletereply and update debate to always deletecomment

include 'database.php';
include 'url.php';
include 'deletereplies.php';

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

$Id =  $_GET["id"];


//connect to database and check info
$con = mysqli_connect($host,$user,$password,$database);


// Check connection
if (mysqli_connect_errno($con))
{
    echo $fail . mysqli_connect_error();
}
else
{
    //delete from table reply
    $query = "DELETE FROM reply WHERE id_reply = '$Id'";
    mysqli_query($con,$query);


    //delete from table photo
    $query2 = "DELETE FROM photo WHERE id = '$Id'";
    mysqli_query($con,$query2);

    // recursively remove a directory
    $dir = "../photos/".$Id;
    foreach(glob($dir . '/*') as $file)
    {
        if(is_dir($file))
            rmdir($file);
        else
            unlink($file);
    }
    if(is_dir($dir))
        rmdir($dir);

    //recursively delete all replies and its respective photos
    delete_children($Id);



    mysqli_close($con);

    header( $base_url. 'php/forum.php' ) ;



}


?>