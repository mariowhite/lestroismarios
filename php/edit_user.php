<?php
	session_start();
	if (!isset($_SESSION['user']))
	header("Location: customer.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Les Trois Marios Inc.</title>
	<meta charset="utf-8">
	
	<link rel="stylesheet" href="../css/reset.css" type="text/css" media="all">
	<link rel="stylesheet" href="../css/layout.css" type="text/css" media="all">
	<link rel="stylesheet" href="../css/style.css" type="text/css" media="all">
	<script type="text/javascript" src="../js/validation.js"></script>
    <script language="JavaScript" src="../js/rows.js"></script>
	<script type="text/javascript" src="../js/jquery-1.4.2.js" ></script>
	<script type="text/javascript" src="../js/cufon-yui.js"></script>
	<script type="text/javascript" src="../js/cufon-replace.js"></script>
	<script type="text/javascript" src="../js/Myriad_Pro_400.font.js"></script>
	<script type="text/javascript" src="../js/Myriad_Pro_300.font.js"></script>

	<script type="text/javascript" src="../js/languages.js"></script>

	<!--[if lt IE 9]>
		<script type="text/javascript" src="js/ie6_script_other.js"></script>
		<script type="text/javascript" src="js/html5.js"></script>
	<![endif]-->

	
</head>

<body id="page3">

<?php

if(isset($_COOKIE["language"]))
{
	if($_COOKIE["language"]=="fr")
		include("fr.php");
	else
		include("en.php");
}
else
	include("en.php");
?>

<!-- START PAGE SOURCE -->
<div class="extra">
  <div class="body1">
    <div class="main">
      <header>
		  <?php
		  include"header.php";
		  ?>
      </header>
      
      
      <section id="content">
        <div class="line1">
         <!--left column -->
         <article class="col1">
          <h2><?php echo $user_edit_title;?>:</h2>


			 <?php

				 if(isset($_GET['msg']))
				 {
					 $title = urldecode($_GET["msg"]);
					 echo "<h2 style='color: red;  font-size:18px; font-weight: 600;margin-left: 10px;'>".$title."</h2>";

				 }

			 ?>
                    
		<?php

			include 'database.php';

			//connect to database and check info
			$con = mysqli_connect($host,$user,$password,$database);


			// Check connection
			if (mysqli_connect_errno($con))
			{
  				echo $fail . mysqli_connect_error();
			}
			else
			{
				$query = "SELECT * FROM users";
				$result = mysqli_query($con,$query);

				if(mysqli_num_rows($result)) {

					echo "<table class='altrowstable' id='alternatecolor' style='width: 103%;'>";
					echo "<tr>";
					echo "<th>".$completename."</th>";
					echo "<th>".$newuser_name."</th>";

					if (isset($_SESSION['type']))
						if ($_SESSION['type'] == "Director")
								echo "<th>".$user_password."</th>";

								echo "<th>".$useremail."</th>";
								echo "<th>".$user_type."</th>";
								echo "<th style = 'width:80px;'>Options</th>";
							echo"</tr>";
		
						while ($row = mysqli_fetch_array($result))
						{							 
							echo"<tr>";
								echo"<td>".$row['name']."</td>";
								echo"<td>".$row['username']."</td>";

							if (isset($_SESSION['type']))
								if ($_SESSION['type'] == "Director")
								echo"<td>".$row['password']."</td>";

								echo"<td>".$row['email']."<br>";
								if($row['notify'])
									echo $receiving;
								else
									echo $not_receiving;
								echo"</td>";
								echo"<td>".$row['type']."</td>";

							echo "<td>
										<a href='edit_user_field.php?user=".$row['username']."'><img style='width:30px; heigth:30px;' src='../images/edituser.png' alt='' Title='".$editbutton."'></a>
							        	<a href='delete_user.php?user=".$row['username']."' onclick='return confirm(\"$dialog\");'><img style='width:30px; heigth:30px;' src='../images/deleteuser.png' alt='' Title='".$deletebutton."'></a>
							      </td>";

							echo"</tr>";
						}
						
						echo"</table>";
					
						
					
				}
			mysqli_close($con);
		}

		?>
		<div style="text-align: center; margin-top: 30px;">
			 <a href='addnewuser.php'><img style='width:110px; heigth:110px;' src='../images/adduser.png' alt='' Title='<?php echo $add_user;?>'></a>

		</div>
        
          
         
          </article>
          
          
        <!--right column -->
          <article class="col2 pad_left1">
			  <?php
			       include"right_menu.php";
			  ?>
			</article>
          
        </div>
      </section>
    </div>
  </div>
  <div class="block"></div>
</div>
<div class="body2">
  <div class="main">
    <footer>
		<?php include "footer.php"; ?>
    </footer>
  </div>
</div>
<!-- END PAGE SOURCE -->
</html>