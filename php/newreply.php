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
	if (mysqli_connect_errno())
	{
		echo $fail . mysqli_connect_error();
	}
	else
	{
			$message = mysqli_real_escape_string($con,$_POST['message']);
			//$subject = mysqli_real_escape_string($con,$_POST['subject']);


			$sql1 = "SELECT id_contract FROM complaints WHERE id_complaint = ". $complaintId;
			$result1 = mysqli_query($con, $sql1);

			if(!mysqli_num_rows($result1))
			{
				$sql1 = "SELECT id_contract FROM reply WHERE id_reply = ". $complaintId;
				$result1 = mysqli_query($con, $sql1);
			}

			$row = mysqli_fetch_array($result1);
			$idcontract = $row['id_contract'];

					if($_SESSION['type'] != "Director")
					{

						$sql = "INSERT INTO reply (text, username, date, id_parent, approve, id_contract)
								VALUES('$message','$active_user', '$actual_date', $complaintId, 0, '$idcontract')";
					}
					else
					{

						$sql = "INSERT INTO reply (text, username, date, id_parent, approve, id_contract)
								VALUES('$message','$active_user', '$actual_date', $complaintId, 1, '$idcontract')";
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

						}


					}

		mysqli_close($con);
			
	}
	

	header( $base_url. 'php/forum.php');
	
?>
