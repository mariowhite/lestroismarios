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

$con = mysqli_connect($host, $user, $password, $database);

// Check connection
if (mysqli_connect_errno($con)) {
    echo $fail . mysqli_connect_error();
} else {
    $name = mysqli_real_escape_string($con, $_POST["name"]);
    $username = mysqli_real_escape_string($con, $_POST["username"]);
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $pwd = mysqli_real_escape_string($con, $_POST["pwd1"]);
    $type = mysqli_real_escape_string($con, $_POST["usertype"]);

    $sql = "INSERT INTO users (name, username, password, email, type)
	VALUES('$name','$username','$pwd','$email', '$type')";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }
    else {
            //if new type of user equal to Director, associate him with all contracts
            if($type == "Director") {
                $query = "SELECT * FROM contracts";
                $contracts = mysqli_query($con, $query) or die( $fail . mysqli_connect_error());

                if(mysqli_num_rows($contracts))
                {
                    while($row = mysqli_fetch_array($contracts))
                    {
                        $query2 = "INSERT INTO users_contracts (id_name_contract, username) VALUES ('".$row['id_name']."', '".$username."')";
                        mysqli_query($con, $query2) or die( $fail . mysqli_connect_error());

                    }

                }
            }

        mysqli_close($con);
        header( $base_url. 'php/edit_user.php?msg='.urlencode($msg2)) ;
    }

}



?>
  
