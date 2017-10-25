
<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Les Trois Marios Inc.</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../css/reset.css" type="text/css" media="all">
	<link rel="stylesheet" href="../css/layout.css" type="text/css" media="all">
	<link rel="stylesheet" href="../css/style.css" type="text/css" media="all">

  <!-- new library ------------------------------------------------  -->
  <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
  <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

  <script type="text/javascript" src="../js/jquery-1.12.0.min.js"></script>

  <script type="text/javascript" src="../js/languages.js"></script>
  <script type="text/javascript" src="../js/validation.js"></script>


	<script type="text/javascript" src="../js/cufon-yui.js"></script>
	<script type="text/javascript" src="../js/cufon-replace.js"></script>
	<script type="text/javascript" src="../js/Myriad_Pro_400.font.js"></script>
	<script type="text/javascript" src="../js/Myriad_Pro_300.font.js"></script>



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
    <div class="main1">
      <header>
        <?php
        include ("header.php");

        ?>
      </header>
      <section id="content">
        <div class="line11">
          <article class="col11">
            <h2><?php echo $contactform;?>: </h2>
            
            <?php
            if(isset($_GET['msg']))
            {
                $title = urldecode($_GET["msg"]);
				echo "<h5 style='color:red; font-size:13px; margin-left:20px; letter-spacing: 0px'>".$title."</h5>";
            }
			
			?>
            <form id="ContactForm"  method="post" onsubmit="return checkEmailForm();" action="mail.php">
            
                <p><input type="text" name="name" id="name" value="<?php echo $name;?>" maxlength="30" size="30"
                onfocus=" if(this.value  == '<?php echo $name;?>') { this.value = ''; } "
                onblur="if(this.value == '') { this.value = '<?php echo $name;?>'; } " /></p>

                <p><input type="text" name="email" id="email" value="<?php echo $email;?>" maxlength="50" size="50"
                onfocus=" if(this.value  == '<?php echo $email;?>') { this.value = ''; } "
                onblur="if(this.value == '') { this.value = '<?php echo $email;?>'; } " /></p>

                <p><input type="text" name="subject" id="subject" value="<?php echo $subject;?>" maxlength="30" size="30"
                onfocus=" if(this.value  == '<?php echo $subject;?>') { this.value = ''; } "
                onblur="if(this.value == '') { this.value = '<?php echo $subject;?>'; } "/></p>

                <p><textarea name="message" rows="6" cols="66" id="message"
                onfocus=" if(this.value  == '<?php echo $message;?>') { this.value = ''; } "
                onblur="if(this.value == '') { this.value = '<?php echo $message;?>'; } "><?php echo $message;?></textarea></p>
                <p>
                    <input id="lang" type="submit" value="<?php echo $send;?>" class="button" />
                    <input type="reset" value="<?php echo $reset;?>" class="button" />
                </p>
			
            </form>
            
          </article>
          <article class="col22 pad_left1">
             <h2><?php echo $our;?>:</h2>
            <div class="wrapper pad_bot1">
              <figure class="left marg_right2"><img class="css3" src="../images/page1_img2.jpg" alt=""></figure>
              <figure class="left marg_right2"><img class="css3" src="../images/page1_img3.jpg" alt=""></figure>
              <figure class="left"><img class="css3" src="../images/page1_img4.jpg" alt=""></figure>
            </div>
            <div class="wrapper pad_bot3">
              <figure class="left marg_right2"><img class="css3" src="../images/page1_img5.jpg" alt=""></figure>
              <figure class="left marg_right2"><img class="css3" src="../images/page1_img6.jpg" alt=""></figure>
              <figure class="left"><img class="css3" src="../images/page1_img7.jpg" alt=""></figure>
            </div>
            
            
            <h2><?php echo $our_contact;?>:</h2>
            <img style='height: auto;width: 310px; margin-left: -30px; margin-top: -10px;' src='../images/contactus.png' alt=''>
            <?php

            /*
            <p class="col_1 contact1"> <?php echo $country;?>: <br>
              <?php echo $city;?>: <br>
              <?php echo $phone;?>: <br>
            <!--  <?php echo $email_address;?>: </p>  -->

            <p class="col_2 contact2"> Canada<br>
              Montr&eacute;al<br>
              514-668-2822<br>
              <!-- <a href="#">mdennys.blanco@lestroismarios.com</a> </p> -->
            */
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