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

           $(document).on("submit","#login",function(){


               var name = $("#name").val();
               var email = $("#email").val();
               var username = $("#username").val();
               var pwd1 = $("#pwd1").val();
               var pwd2 = $("#pwd2").val();

               if(name == "" || email == "" || $("#username-result>img").attr('src') == "../images/not-available.png" || username == "" || pwd1 != pwd2 || $("input[name=usertype]:checked").val() === undefined)
               {

                   if ($("#mylang").text() == "Complete Name: ")
                        alert("Please complete form correctly.");
                   else
                       alert("S'il vous plaît remplir le formulaire correctement.");

                   return false;
               }

           });

            $("#username").keyup(function()
            {
                //check that username is not already in used
                var username = $("#username").val();

                $.ajax({
                    url: 'check_username.php',
                    type: 'POST',
                    data: 'username=' + username,
                    success: function(result){

                        $("#username-result").html(result);
                    }

                });
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
          <h2><?php echo $usertitle; ?>:</h2>
            
        
          <!--left column -->
         <form id="login"  method="post" action="newusers.php">
        
            <label id="mylang"><?php echo $completename; ?>: </label>
            <p>
            <input type="text" name="name" id="name" value="" size="40" />
            </p>
            
            <label><?php echo $useremail; ?>: </label>
            <p><input class="email" type="text" name="email" id="email" size="40"/></p>

             <label><?php echo $newuser_name; ?>: </label>
             <p>
                 <input type="text" name="username" id="username" value=""/>
                 <span id="username-result"></span>
             </p>

             <label><?php echo $user_password; ?>: </label>
            <p><input type="password" name="pwd1" id="pwd1" /></p>

             <label><?php echo $user_confirm; ?>: </label>
            <p><input type="password" name="pwd2" id="pwd2" /></p>

             <div id="typeofuser">
             <label><?php echo $user_type; ?>: </label>
            <p style="padding-top: 5px; padding-left: 10px;">
                <input style="margin-bottom: 10px;" type="radio" name="usertype"  value="User"><label><?php echo $user_type_user; ?></label><br>
                <input style="margin-bottom: 10px;" type="radio" name="usertype"  value="Director"><label><?php echo $user_type_director; ?></label><br>
                <input style="margin-bottom: 10px;" type="radio" name="usertype"  value="Administrator"><label><?php echo $user_type_administrator; ?></label><br>
                <input style="margin-bottom: 10px;" type="radio" name="usertype"  value="Manager"><label><?php echo $user_type_manager; ?></label><br>

            </p>
            </div>
             <p>
				<input type="submit" value="<?php echo $create_user; ?>" class="button" />
				<input type="reset" value="RESET" class="button" />
			</p>

		</form>
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