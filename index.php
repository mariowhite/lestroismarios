<?php
	session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Les Trois Marios Inc.</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all">

	<script type="text/javascript" src="js/jquery-1.4.2.js" ></script>
	<script type="text/javascript" src="js/cufon-yui.js"></script>
	<script type="text/javascript" src="js/cufon-replace.js"></script>
	<script type="text/javascript" src="js/Myriad_Pro_400.font.js"></script>
	<script type="text/javascript" src="js/Myriad_Pro_300.font.js"></script>

  <!-- new library ------------------------------------------------  -->
  <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
  <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

  <script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>

  <script type="text/javascript" src="js/languages.js"></script>

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
    include("php/fr.php");
  else
    include("php/en.php");
}
else
  include("php/en.php");
?>


<!-- START PAGE SOURCE -->
<div class="extra">
  <div class="body1">
    <div class="main1">
      <header>

        <div class="wrapper">

          <img style='height: 70px;width: 340px; float: left' src='images/cleaning-about-icons.png' alt=''>
          <img style='height: 70px;width: 340px float: left' src='images/cleaning-about-icons.png' alt=''>

          <!-- <img style='height: 70px;width: 135px' src='images/cleaning-about-icons2.png' alt=''> -->

          <ul id="icons">
          	<?php
        		
				if(isset($_SESSION['user']))
				{

                  echo "<li><a href='php/logout.php'><img class='css3' src='images/logout4.ico' style='padding: 1px' width='35' height='35' alt='' Title='".$logout."'></a><li>";
			
				}
			?>

            <li><a href="" onclick="change_to_EN();"><img class="css3" src="images/en.png" width="36" height="36" alt="en"  Title="<?php echo $english;?>"></a></li>
            <li><a href="" onclick="change_to_FR();"><img class="css3" src="images/fr.png" width="36" height="36" alt="fr"  Title="<?php echo $french;?>"></a></li>



          </ul>
        </div>
        <nav>
          <ul id="menu">
            <li id="menu_active"><a href="index.php"><?php echo $home;?></a></li>
            <li><a href="php/services.php"><?php echo $services;?></a></li>
      
            <li><a href="php/contacts.php"><?php echo $contact;?></a></li>
             <?php
        		
				if(isset($_SESSION['user']))
					echo "<li><a href='php/forum.php'>".$blog."</a></li>";
				else
					echo "<li><a href='php/customer.php'>".$customer."</a></li>";
			?>
          </ul>
        </nav>
        <div class="text1"> <?php echo $message1;?> <span><?php echo $message2;?></span> </div>
        <p>
       </p>
      </header>
      
      
      <section id="content">
        <div class="line11">
          <article class="col11">
            <h2><?php echo $welcome;?>:</h2>
            <div class="wrapper pad_bot3">
              <figure class="left marg_right1"><img style="width: 220px; height: 220px;" class="css3" src="images/page1_img1.jpg" alt=""></figure>
              <p><?php echo $part1;?></p>
              <p>
                <?php echo $part2;?>
              </p>
			  <p>
                <?php echo $part3;?>
              </p>
		</div>
          </article>
		  
          <article class="col22 pad_left1">
            <h2><?php echo $our;?>:</h2>
            <div class="wrapper pad_bot1">
              <figure class="left marg_right2"><img class="css3" src="images/page1_img2.jpg" alt=""></figure>
              <figure class="left marg_right2"><img class="css3" src="images/page1_img3.jpg" alt=""></figure>
              <figure class="left"><img class="css3" src="images/page1_img4.jpg" alt=""></figure>
            </div>
            <div class="wrapper pad_bot3">
              <figure class="left marg_right2"><img class="css3" src="images/page1_img5.jpg" alt=""></figure>
              <figure class="left marg_right2"><img class="css3" src="images/page1_img6.jpg" alt=""></figure>
              <figure class="left"><img class="css3" src="images/page1_img7.jpg" alt=""></figure>
            </div>
            
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
      <?php include "php/footer.php"; ?>
    </footer>
  </div>
</div>
<!-- END PAGE SOURCE -->
</html>