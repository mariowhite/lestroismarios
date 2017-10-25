<?php

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


	include 'database.php';
	include 'url.php';
	include 'emails.php';
 
 		
	$active_user = $_SESSION['user'];
	
	$actual_date = date("Y-m-d H:i:s");  

	$con = mysqli_connect($host,$user,$password,$database);
	

	// Check connection
	if (mysqli_connect_errno())
	{
		echo $fail . mysqli_connect_error();
	}
	else
	{
			$message = mysqli_real_escape_string($con,$_POST['message']);
			$subject = mysqli_real_escape_string($con,$_POST['subject']);
			$id_contract = mysqli_real_escape_string($con,$_POST['contracts']);

		/*
			$userType = $_POST['usertype'];
			foreach ($userType as $u)
				echo $u;
		*/

		if($_SESSION['type'] != "Director") {
			$sql = "INSERT INTO complaints (text, subject, date, username, approve, id_contract)
			VALUES('$message','$subject','$actual_date','$active_user',0 ,'$id_contract')";
		}
		else{
			$sql = "INSERT INTO complaints (text, subject, date, username, approve, id_contract)
			VALUES('$message','$subject','$actual_date','$active_user',1 ,'$id_contract')";

		}
					
			if (!mysqli_query($con,$sql))
			{
				die('Error: ' . mysqli_error($con));
			}
			else
			{
				$idcomplaint = $con->insert_id;

				if($_SESSION['type'] != "Director") {

					mysqli_query($con,'SET foreign_key_checks = 0');
						$sql2 = "INSERT INTO users_autorized(id_complaint, usertype) VALUES('" . $idcomplaint . "','".$_SESSION['type']."')";
						mysqli_query($con, $sql2) or die($fail . mysqli_connect_error());
					mysqli_query($con,'SET foreign_key_checks = 1');

					//notify directors by email
					//Get email of all director
					//send an email to each of them notifying of new comment

					$user_sending = $_SESSION['name'];
					$subject_sent = $subject;
					$content_sent = $message;

					email_directors($user_sending,$subject_sent,$content_sent);

				}

				if($_SESSION['type'] == "Director") {
					//save all authorized users in database
					$userType = $_POST['usertype'];
					mysqli_query($con,'SET foreign_key_checks = 0');
					foreach ($userType as $u) {
						$sql2 = "INSERT INTO users_autorized(id_complaint, usertype) VALUES('" . $idcomplaint . "','" . $u . "')";
						mysqli_query($con, $sql2) or die($fail . mysqli_connect_error());

						//notify user of type $u
						$user_sending = $_SESSION['name'];
						$subject_sent = $subject;
						$content_sent = $message;

						email_users($u,$idcomplaint,$user_sending,$subject_sent,$content_sent);

					}
					mysqli_query($con,'SET foreign_key_checks = 1');


					//notify other directors by email
					$user_sending = $_SESSION['name'];
					$subject_sent = $subject;
					$content_sent = $message;

					email_directors($user_sending,$subject_sent,$content_sent);


				}



				mysqli_close($con);
				
				if(!isset($_POST['SEND'])) //nned to continue to upload photos
				{

					header( $base_url. 'php/upload.php?idcomplaint='.$idcomplaint);

				}
				else
				{

					header( $base_url. 'php/forum.php');

				}
			}
	}
	
	
	
	
