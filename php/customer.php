<?php
session_start();
if (isset($_SESSION['user']))
	header("Location: forum.php");
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
	<script type="text/javascript" src="../js/jquery-1.4.2.js" ></script>
    
	<script type="text/javascript" src="../js/cufon-yui.js"></script>
	<script type="text/javascript" src="../js/cufon-replace.js"></script>
	<script type="text/javascript" src="../js/Myriad_Pro_400.font.js"></script>
	<script type="text/javascript" src="../js/Myriad_Pro_300.font.js"></script>

	<!-- new library ------------------------------------------------  -->
	<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

	<script type="text/javascript" src="../js/jquery-1.12.0.min.js"></script>

	<script type="text/javascript" src="../js/languages.js"></script>

	<!--[if lt IE 9]>
	<script type="text/javascript" src="../js/ie6_script_other.js"></script>
	<script type="text/javascript" src="../js/html5.js"></script>
	<![endif]-->
</head>
<body id="page5">

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
        		include "header.php";
		  ?>
      </header>
      <section id="content">
        <h2 style="text-align: center"><?php echo $enter;?>:</h2>


			<div style="float: left; margin:0 40px 0 300px;">

				<img style='width:180px; heigth:180px;' src='../images/login2.png' alt=''>

			</div>
        	<div>


				<form id="login"  method="post" onsubmit="return checkLoginForm();" action="login.php">
        
					<p>
						<label><?php echo $newuser_name; ?>: </label><br>
						<input type="text" name="username" id="username" value="" maxlength="20" size="20"/>
					</p>

					<p>
						<label><?php echo $user_password; ?>: </label><br>
						<input type="password" name="pwd" id="pwd" maxlength="20" size="20"/>
					</p>

					<p>
						<input type="submit" value="<?php echo $login;?>" class="button" style="width: 160px;"/>
					</p>

				</form>
				<?php
				if(isset($_GET['msg']))
				{
					$message = 	$_GET['msg'];
					echo "<h5 style='color:red; padding-bottom:0px;letter-spacing: -0.2px; position: relative; right: 10px;'>".$message."</h5>";

				}
				?>
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