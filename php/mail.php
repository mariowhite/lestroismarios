<?php
	
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


	$name = $_POST['name'] ;
	$email = $_POST['email'] ;
  	$subject = $_POST['subject'] ;
  	$message = $_POST['message'] ;
	
	$header = "From: ".$name. " <".$email.">";
	

  	$ok = mail($sent_to, $subject, $message, $header);
  	
	if($ok)
	{

		header( $base_url. 'php/contacts.php?msg='.urlencode($msg7));
		
	}
	else
	{

		header( $base_url. 'php/contacts.php?msg='.urlencode($msg8));
	}
  	

?>