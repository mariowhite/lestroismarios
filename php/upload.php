<?php
  session_start();
  if (!isset($_SESSION['user']))
    header("Location: customer.php");

	include 'database.php';
	include 'url.php';

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

  <!-- new library ------------------------------------------------  -->
  <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
  <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

  <script type="text/javascript" src="../js/jquery-1.12.0.min.js"></script>

  <script type="text/javascript" src="../js/languages.js"></script>

	<script type="text/javascript" src="../js/cufon-yui.js"></script>
	<script type="text/javascript" src="../js/validation.js"></script>
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
    <div class="main">
      <header>
        <?php
        include "header.php";
        ?>
      </header>
      <section id="content">
        <div class="line1">
          <article class="col1">
            <h2><?php echo $upload2;?>: </h2>

            <?php
            if(isset($_GET['msg']))
            {
              $message = 	$_GET['msg'];
              echo "<label style='color:red;font-size: 14px; margin-left: 85px;'>".$message."</label>";

            }
            ?>

                <form action="upload_photo.php<?php echo "?id=".$_GET["idcomplaint"];?>" method="post" enctype="multipart/form-data" style='width:100%;margin-left: 5px;margin-top: 10px;'>

                    <label style="vertical-align: middle"><?php echo $description;?>: </label>
                      <input type="text" id="description" name="description" maxlength="65" style="width: 401px;margin-bottom: 10px; height: 25px;">

                    <input type="file" name="file" id="file" style="width:400px; margin-left: 78px; margin-bottom: 8px;">
                      <br>
                    <input style="float: right; position: relative; top: -77px; right:30px; width: 120px; height: 70px;" type="submit" name="UPLOAD" value="<?php echo $upload3;?>" class="button" title="<?php echo $upload4;?>">
                  <?php
                  include "get_uploaded_photos.php";
                  ?>

                  <input style="margin-left: 235px; margin-top: 10px; width:190px; height: 40px;" type="submit" name="FINISH" value="<?php echo $finish;?>" class="button" title="<?php echo $finishtitle;?>">

                </form>


            
            
            
          </article>
          <article class="col2 pad_left1">
            <?php
            include "right_menu.php";
            include "filtering.php";
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