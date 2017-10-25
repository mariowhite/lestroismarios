<?php

include 'database.php';
include 'url.php';
include 'emails.php';

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

$idcomplaint = $_GET["id"];

if(isset($_POST['FINISH']))
{
	//Get email of all director
	//send an email to each of them notifying of new comment

	//email_directors();

	header( $base_url. 'php/forum.php');
}
else
{
	
	$con=mysqli_connect($host,$user,$password,$database);

	// Check connection
	if (mysqli_connect_errno())
	{
		echo $fail . mysqli_connect_error();
	}
	else
	{
	
			$allowedExts = array("gif", "jpeg", "jpg", "png");
			$temp = explode(".", $_FILES["file"]["name"]);
			$extension = end($temp);
			if (((strtolower($_FILES["file"]["type"]) == "image/gif") || (strtolower($_FILES["file"]["type"]) == "image/jpeg") || (strtolower($_FILES["file"]["type"]) == "image/png"))
				&& ($_FILES["file"]["size"] < 12000000) && in_array($extension, $allowedExts))
				{
					if ($_FILES["file"]["error"] > 0)
					{
						echo "Error: " . $_FILES["file"]["error"] . "<br>";
					}
					else
					{
						$filename = $_FILES ["file"] ["name"];
						$filesize = round(($_FILES ["file"] ["size"] / 1024),2);
						$description = $_POST['description'];
						
						//insert into database info
						$sql = "INSERT INTO photo (id, filename, filesize, description)
						VALUES('$idcomplaint','$filename','$filesize','$description')";
							
									
							if (!mysqli_query($con,$sql))
							{
								die('Error: ' . mysqli_error($con));
							}
							else
							{
								//save in hard drive
								//create a directory if it does not exists
								if (! file_exists ( "../photos/" .$idcomplaint)) 
								{
									mkdir("../photos/".$idcomplaint);
									chmod("../photos/".$idcomplaint, 0777);
								}


								//optimize image
								//*********************************************************************************************************************
								// Create image from file
								switch(strtolower($_FILES['file']['type']))
								{
									case 'image/jpeg':
										$image = imagecreatefromjpeg($_FILES['file']['tmp_name']);
										break;
									case 'image/png':
										$image = imagecreatefrompng($_FILES['file']['tmp_name']);
										break;
									case 'image/gif':
										$image = imagecreatefromgif($_FILES['file']['tmp_name']);
										break;
									default:
										exit('Unsupported type: '.$_FILES['file']['type']);
								}

								// Delete original file
								@unlink($_FILES['file']['tmp_name']);


								// Target dimensions
								$max_width = 900;
								$max_height = 1600;


								// Calculate new dimensions
								$old_width      = imagesx($image);
								$old_height     = imagesy($image);
								$scale          = min($max_width/$old_width, $max_height/$old_height);
								$new_width      = ceil($scale*$old_width);
								$new_height     = ceil($scale*$old_height);


								// Create new empty image
								$new = imagecreatetruecolor($new_width, $new_height);


								// Resample old into new
								imagecopyresampled($new, $image, 0, 0, 0, 0, $new_width, $new_height, $old_width, $old_height);


								// Catch the image data
								ob_start();
								imagejpeg($new, "../photos/" . $idcomplaint . "/" . $filename , 90); //saving optimized image in the folder
								$data = ob_get_clean();


								// Destroy resources
								imagedestroy($image);
								imagedestroy($new);


								// Output image data
								//echo $data;

								//*********************************************************************************************************************


									//save file in server folders
									//move_uploaded_file ( $_FILES ["file"] ["tmp_name"], "../photos/".$idcomplaint."/". $filename );
									chmod("photos/".$idcomplaint."/".$filename, 0777);
												
									$errors.= $done.="<br />";
							}

						mysqli_close($con);
						header( $base_url. 'php/upload.php?idcomplaint='.$idcomplaint);
						
					}
				}
				else
				{

					header( $base_url. 'php/upload.php?idcomplaint='.$idcomplaint."&msg=".$msg9);
				}


	}


}


?>