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

	<script>

	$(document).ready(function(){

		$("#username").mouseover(function() {

			$(this).css("border-color", "red");
			$(this).css("background","#eee none repeat scroll 0 0");

		});

		$("#username").mouseout(function() {

			$(this).css("border-color", "#ccc");
			$(this).css("background","#eee none repeat scroll 0 0");

		});

		$("#pwd1").keydown(function() {

			$("#pwd2").val("");


		});

		$(document).on("submit","#login",function(){

			var name = $("#name").val();
			var email = $("#email").val();
			var username = $("#username").val();
			var pwd1 = $("#pwd1").val();
			var pwd2 = $("#pwd2").val();

			if(name == "" || email == "" || username == "" || pwd1 != pwd2)
			{
					var mylang = $("#mylang").text();


					if (mylang == "Complete Name: ") {
						alert("Please complete the form correctly.");
					}
					else {
						alert("S'il vous plaît remplir le formulaire correctement.");
					}

					return false;
			}

			//if user logged is a director
			if($("#typeofuser").length) {
				if ($("input[name=usertype]:checked").val() === undefined) {

					var mylang = $("#mylang").text();


					if (mylang == "Complete Name: ") {
						alert("Please complete the form correctly.");
					}
					else {
						alert("S'il vous plaît remplir le formulaire correctement.");
					}

					return false;
				}
			}


		});


		$(document).on("click","#notify",function(){

			if($(this).val() == 1)
				$(this).val("0");
			else
				$(this).val("1");

		});



		//close of document ready
	});


	</script>
	
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
			include "header.php";
		  ?>

	  </header>
      
      
      <section id="content">
        <div class="line1">
         <!--left column -->
         <article class="col1">
         
          <h2><?php echo $user_info; ?></h2>
            
		<?php
			$username = $_GET["user"];
			
			include 'database.php';

			//connect to database and check info
			$con = mysqli_connect($host,$user,$password,$database);


			// Check connection
			if (mysqli_connect_errno())
			{
  				echo $fail . mysqli_connect_error();
			}
			else
			{
	
				$query = "SELECT * FROM users WHERE username='".$username."'";
				$result = mysqli_query($con,$query);
				
				
				if(mysqli_num_rows($result))
				{
					//left column
					 $row = mysqli_fetch_array($result);
					
					 echo "<form id='login'  method='post' action='edit.php'>";
						?>
								<label id="mylang"><?php echo $completename; ?>: </label>
								<p>
								<input type='text' name="name" id="name" value="<?php echo $row['name']?>" size="40" title="<?php echo $completename;?>"/>
								</p>

								<label><?php echo $useremail; ?>: </label>
								<p style="padding-bottom: 1px;">
									<input class="email" type="text" name="email" id="email" size="40" value="<?php echo $row['email']?>" title="<?php echo $useremail;?>"/>
								</p>
								<p>
									<input type="checkbox" name="notify" id="notify" value="<?php if($row['notify']) echo "1"; else echo "0";?>" <?php if($row['notify']) echo "checked";?>><label><?php echo $notifications;?></label>
								</p>

								 <label><?php echo $newuser_name; ?>: </label>
								 <p>
									 <input type="text" name="username" id="username" value="<?php echo $row['username']?>" readonly="readonly" title="<?php echo $user_restriction; ?>"/>
									 <span id="username-result"></span>
								 </p>

								 <label><?php echo $user_password; ?>: </label>
								<p><input type="password" name="pwd1" id="pwd1" value="<?php echo $row['password']?>" title="<?php echo $user_password; ?>" /></p>

								 <label><?php echo $user_confirm; ?>: </label>
								<p><input type="password" name="pwd2" id="pwd2" value="<?php echo $row['password']?>" title="<?php echo $user_confirm; ?>"/></p>

					<?php
					if($_SESSION['type'] == "Director") {
					?>

						<div id="typeofuser">
							<label><?php echo $user_type;?>: </label>

							<p style="padding-top: 5px; padding-left: 10px;">
								<input style="margin-bottom: 10px;" type="radio" name="usertype"
									   value="User" <?php if ($row['type'] == "User") echo "checked"; ?>><label><?php echo $user_type_user; ?></label><br>
								<input style="margin-bottom: 10px;" type="radio" name="usertype"
									   value="Director" <?php if ($row['type'] == "Director") echo "checked"; ?>><label><?php echo $user_type_director; ?></label><br>
								<input style="margin-bottom: 10px;" type="radio" name="usertype"
									   value="Administrator" <?php if ($row['type'] == "Administrator") echo "checked"; ?>><label><?php echo $user_type_administrator; ?></label><br>
								<input style="margin-bottom: 10px;" type="radio" name="usertype"
									   value="Manager" <?php if ($row['type'] == "Manager") echo "checked"; ?>><label><?php echo $user_type_manager; ?></label><br>

							</p>
						</div>
					<?php
					}
					else
						echo "<input type='text' name='usertype' id='usertype' value='".$row['type']."' hidden/>";

					?>
								 <p>
									<input type="submit" value="<?php echo $save; ?>" class="button" />
									<input type="reset" value="RESET" class="button" />
								</p>

					<?php
					echo "</form>";
				}
				mysqli_close($con);
			
			}
		?>        
        
        
          
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

