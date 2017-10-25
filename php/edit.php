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

$con = mysqli_connect($host,$user,$password,$database);

// Check connection
if (mysqli_connect_errno())
{
  	echo $fail . mysqli_connect_error();
}
else
{

			$name = mysqli_real_escape_string($con, $_POST["name"]);
			$username = mysqli_real_escape_string($con, $_POST["username"]);
			$email = mysqli_real_escape_string($con, $_POST["email"]);
			$pwd = mysqli_real_escape_string($con, $_POST["pwd1"]);
			$type = mysqli_real_escape_string($con, $_POST["usertype"]);
			if(isset($_POST["notify"]))
				$notify = 1;
			else
				$notify = 0;

		$sql = "UPDATE users SET name = '".$name."', password = '".$pwd."', email ='".$email."', type='".$type."' , notify = ".$notify." WHERE username = '".$username."'";

		if (!mysqli_query($con,$sql))
		{
			die('Error: ' . mysqli_error($con));
		}

	mysqli_close($con);

	if($_SESSION['type'] == "Director")
		header( $base_url. 'php/edit_user.php?msg='.urlencode($msg1)) ;
	else
		header( $base_url. 'php/edit_user_field.php?user='.$username) ;


}

