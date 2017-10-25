<?php
  include 'database.php';
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

	<script type="text/javascript" src="../js/jquery-1.4.2.js" ></script>
	<script type="text/javascript" src="../js/cufon-yui.js"></script>
	<script type="text/javascript" src="../js/validation.js"></script>
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

    $(document).ready(function() {

      //check form on submit
      $(document).on("submit","#ContactForm",function(){


        var subject = $("#subject").val();
        var message = $("#message").val();

        //check if user logged in is a director
        var sessionValue = "<?php print $_SESSION["type"];?>";
        var selected = [];
        if(sessionValue == "Director")
        {
          $('#typeofuser2 input:checked').each(function() {
            selected.push($(this).attr('value'));
          });
        }
        //console.log(selected);

        var mylang = $("#mylang").text();
        if(subject == "" || subject == "" || message == "" || $("#contracts").find("option:selected").val() == "default")
        {

          if (mylang == "Contract Name:")
          {
            alert("Please complete the form correctly.");
          }
          else
          {
            alert("S'il vous plaît remplir le formulaire correctement.");
          }

          return false;
        }
        else if(sessionValue == "Director")
        {
            if(selected.length == 0)
            {
              if (mylang == "Contract Name:")
              {
                alert("Please complete the form correctly.");
              }
              else
              {
                alert("S'il vous plaît remplir le formulaire correctement.");
              }

              return false;

            }
        }





      });






      //closing document ready
    })
  </script>


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
            <h2><?php echo $write_title;?>: </h2>
            
            <form id="ContactForm"  method="post" action="sendcomment.php">

              <?php
              //get all contracts


              //connect to database and check info
              $con = mysqli_connect($host,$user,$password,$database);


              // Check connection
              if (mysqli_connect_errno())
              {
                echo $fail . mysqli_connect_error();
              }
              else
              {

              //--------------------------------------------------------------------------------------------------------
              //contracts
              if($_SESSION['type'] != "Director")
              {
                  //get contracts where this user is assigned to.
                  $query = "SELECT id_name_contract AS id_name FROM users_contracts WHERE username = '".$_SESSION['user']."'";
              }
              else
                  $query = "SELECT * FROM contracts"; //get all contracts

              $result = mysqli_query($con,$query);

              if(mysqli_num_rows($result)) {

              ?>
              <label id="mylang"><?php echo $contract_name;?>:</label>
              <select id="contracts" name="contracts" style="width:292px;">
                <option value="default"><?php echo $select_contract;?></option>

                <?php
                  while ($row = mysqli_fetch_array($result))
                  {
                      echo "<option value='" . $row['id_name'] . "'>" . $row['id_name'] . "</option>";

                  }

                echo "</select>";

                }

                mysqli_close($con);
                }
                //--------------------------------------------------------------------------------------------------------
                ?>

                <?php
                if($_SESSION['type']=="Director") {

                  ?>
                <div id="typeofuser2">
                    <label><?php echo $user_type; ?>: </label>

                    <p style="padding-top: 5px; padding-left: 10px;">

                      <input style="margin-bottom: 10px;" type="checkbox" name="usertype[]" value="User"><label><?php echo $user_type_user; ?></label><br>
                      <input style="margin-bottom: 10px;" type="checkbox" name="usertype[]" value="Administrator"><label><?php echo $user_type_administrator; ?></label><br>
                      <input style="margin-bottom: 10px;" type="checkbox" name="usertype[]" value="Manager"><label><?php echo $user_type_manager; ?></label><br>

                    </p>

                  <?php
                }
                else {
                  echo '<div id="typeofuser3">';
                    echo "<img style='width:140px; heigth:150px;' src='../images/comment.png' alt=''>";
                }
                  ?>
                </div>
                <br><br>
                <label><?php echo $subject;?>:</label>

                  <?php
                    if(isset($_COOKIE["language"])) {
                      if ($_COOKIE["language"] == "en")
                        echo '<input type="text" name="subject" id="subject" maxlength="50" style="width: 335px;"/> ';
                      else
                        echo '<input type="text" name="subject" id="subject" maxlength="50" style="width: 355px;"/>';
                    }
                    else
                      echo '<input type="text" name="subject" id="subject" maxlength="50" style="width: 335px;"/> ';
                  ?>


                <br><br>
                <label><?php echo $content;?>:</label>
                <p><textarea name="message" rows="6" id="message" style="width: 98%;"></textarea>
                </p>


                <p>
                    <input type="submit" value="<?php echo $send;?>"  name="SEND" class="button" title="<?php echo $send_title;?>."/>
                    <input type="submit" value="<?php echo $upload_photos;?>" name="UPLOAD" class="button" title="<?php echo $upload;?>." />
                    <input type="reset" value="<?php echo $reset;?>" class="button" title="<?php echo $clear;?>."/>
                </p>
			
            </form>

            
          </article>
          <article class="col2 pad_left1">
            <?php
                include "right_menu.php";

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