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
    <div class="main1">
      <header>
        <?php
            include ("header.php");
        ?>
      </header>
      
      
      <section id="content">
        <div class="line11">
          <article class="col11">
            <h2><?php echo $overview;?>:</h2>
            
            <div id="Windows Cleaning" class="wrapper pad_bot3">
              <figure class="left marg_right1"><img class="css3" src="../images/windows_cleaning1.jpg" alt=""></figure>
              <strong><?php echo $windows;?></strong><br>
              <?php echo $windows_des;?>
            </div>
            
            <div id="Floor Stripping" class="wrapper pad_bot3">
              <figure class="left marg_right1"><img class="css3" height="113" width="213" src="../images/low-speed-floor-stripping.jpg" alt=""></figure>
              <strong><?php echo $floor2;?> </strong><br>
              <?php echo $floor_des;?>
            </div>
            
            <div id="Carpet Cleaning" class="wrapper pad_bot3">
              <figure class="left marg_right1"><img class="css3"  src="../images/carpet_cleaning1.jpg" alt=""></figure>
              <strong><?php echo $carpet;?>  </strong><br>
              <?php echo $carpet_des;?>
            </div>
            
            <div id="Pressure Washer" class="wrapper pad_bot1">
              <figure class="left marg_right1"><img class="css3" src="../images/pressure_washing1.jpg" alt=""></figure>
              <strong><?php echo $washer;?> </strong><br>
              <?php echo $washer_des;?>
            </div>
            <br>
             <div id="House Maid Services" class="wrapper pad_bot1">
              <figure class="left marg_right1"><img class="css3" height="113" width="213"  src="../images/maid_service.jpg" alt=""></figure>
              <strong><?php echo $house;?> </strong><br>
               <?php echo $house_des;?>
            </div>
            <br>
             <div id="Post-Construction" class="wrapper pad_bot1">
              <figure class="left marg_right1"><img class="css3" height="113" width="213"  src="../images/Post-Construction-Cleaning.jpg" alt=""></figure>
              <strong><?php echo $construction;?> </strong><br>
               <?php echo $construction_des;?>
            </div>
            <br>
            <div id="Graffiti Removal" class="wrapper pad_bot1">
              <figure class="left marg_right1"><img class="css3" height="113" width="213"  src="../images/GraffitiRemoval.jpg" alt=""></figure>
              <strong><?php echo $graffiti;?>  </strong><br>
              <?php echo $graffiti_des;?>
            </div>
            
             
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
            
            
            <h2><?php echo $list;?>:</h2>
            <ul id="services">	
            	<li><a style="width: 85%" class='hvr-underline-from-left' href="services.php#Carpet Cleaning"><?php echo $carpet;?></a></li>
                <li><a style="width: 85%" class='hvr-underline-from-left' href="services.php#Windows Cleaning"><?php echo $windows;?></a></li>
                <li><a style="width: 85%" class='hvr-underline-from-left' href="services.php#Pressure Washer"><?php echo $washer;?></a></li>
                <li><a style="width: 85%" class='hvr-underline-from-left' href="services.php#Floor Stripping"><?php echo $floor;?></a></li>
                <li><a style="width: 85%" class='hvr-underline-from-left' href="services.php#Graffiti Removal"><?php echo $graffiti;?> </a></li>
                <li><a style="width: 85%" class='hvr-underline-from-left' href="services.php#Post-Construction"><?php echo $construction;?></a></li>
                <li><a style="width: 85%" class='hvr-underline-from-left' href="services.php#House Maid Services"><?php echo $house;?></a></li>
               
             
            </ul>
            <br><br>
            <h2><?php echo $our_contact;?>:</h2>
            <img style='height: auto;width: 310px; margin-left: -30px; margin-top: -10px;' src='../images/contactus.png' alt=''>

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