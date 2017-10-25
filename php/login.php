<?php


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

//take values from method POST (user name and password)
$username = $_POST["username"];
$pwd = $_POST["pwd"];

//connect to database and check info
$con=mysqli_connect($host,$user,$password,$database);


// Check connection
if (mysqli_connect_errno($con))
{
  	echo $fail . mysqli_connect_error();
}
else
{
	
	$query = "SELECT * FROM users WHERE username = '$username' && password = '$pwd'";
	$result = mysqli_query($con,$query);


	$row = mysqli_fetch_array($result);

	if($row)
  	{
  		session_start();
  		
		$_SESSION['user'] = $row['username'];
		$_SESSION['name'] = $row['name'];
		$_SESSION['type'] = $row['type'];
  		
  		header( $base_url. 'php/forum.php' ) ;
		
		
  	}
  	else
  	{

		header( $base_url. 'php/customer.php?msg='.urldecode($msg4)) ;
		
  	}

	mysqli_close($con);
}




?>

