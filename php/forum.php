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
    <link rel="stylesheet" href="../css/CalendarControl.css" type="text/css" media="all">
	<link rel="stylesheet" href="../css/invalid.css" type="text/css" media="all">
        
	<script type="text/javascript" src="../js/reply.js" ></script>
    <script type="text/javascript" src="../js/CalendarControl.js" ></script>


	<!-- new library ------------------------------------------------  -->
	<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

	<script type="text/javascript" src="../js/jquery-1.12.0.min.js"></script>



	<!-- <script type="text/javascript" src="../js/jquery-1.4.2.js" ></script> -->
	<script type="text/javascript" src="../js/cufon-yui.js"></script>
	<script type="text/javascript" src="../js/cufon-replace.js"></script>
	<script type="text/javascript" src="../js/Myriad_Pro_400.font.js"></script>
	<script type="text/javascript" src="../js/Myriad_Pro_300.font.js"></script>

	<script type="text/javascript" src="../js/languages.js"></script>

	<!--[if lt IE 9]>
		<script type="text/javascript" src="../js/ie6_script_other.js"></script>
		<script type="text/javascript" src="../js/html5.js"></script>
	<![endif]-->



	<script>


		$(window).load(function() {
			$(".loader").fadeOut("slow");
		})

		$(document).ready(function() {

			$("#debate").load( "debate.php"); //load initial records



	//***************************************************************************
			//5
			//approve comments
			$(document).on('click', ".quickreply5 > img", function(e){
				e.preventDefault();

					var id = $(this).parent().attr('name');
					var value = 1;
					var myimage = $(this);

					if($(this).attr('src') == "../images/yes.png") //authorize or deauthorize
						value = 0;



					$.ajax({
						url: 'approve_comment.php',
						type: 'POST',
						async:false,
						data: {id : id, value : value},
						success: function(){

							//location.reload();
							if(value == 1) {
                                //change image to authorized
								myimage.attr('src', '../images/yes.png');

                                //as the user if he wants to notify authorized users by email
                                if (confirm('Do you want to notify authorized users about this message?')) {

                                        $.ajax({
                                            url: 'notify_users.php',
                                            data: {id : id},
                                            type: 'POST',
                                            cache: false,
                                            success: function (succ) {

                                                alert(succ);

                                            },
                                            error: function (error) {
                                                alert("Error: "+ error);
                                            }
                                        });

                                }

							}
							else {

								myimage.attr('src', '../images/no.png');
							}

						},
						error: function(e){
							console.log("Error: " + e);
						}

					})

			});

//***************************************************************************
			//authorized according to the type of user
			$(document).on('click', ".quickreply6 > img", function(e) {

				e.preventDefault();
				var id = $(this).parent().attr('name');
				var type = $(this).attr('name');

				var action;
				if($(this).attr('src') == "../images/adduser.png")
					action = "Deauthorize";
				else
					action = "Authorize";

				var myimage = $(this);

				$.ajax({
					url: 'authorize_comment.php',
					type: 'POST',
					async:false,
					data: {id : id, type : type, action : action},
					success: function(){

						//location.reload();
						if(action == "Deauthorize") {

							myimage.attr('src', '../images/deleteuser.png');
						}
						else {

							myimage.attr('src', '../images/adduser.png');

							//alert(myimage.parent().parent().prev().children('a.quickreply5').children('img').attr('src'));

                            //check if this message is authorized
                            if(myimage.parent().parent().prev().children('a.quickreply5').children('img').attr('src') == "../images/yes.png")
                            //as the user if he wants to notify authorized users by email


								if (confirm('Do you want to notify users about this new message?')) {

									$.ajax({
										url: 'notify_user_group.php',
										type: 'POST',
										async: false,
										data: {id: id, type: type},
										success: function (succ) {//sent email of type

											alert(succ);
										},
										error: function (error) {
											alert("Error: " + error);
										}
									});

								}


                        }

					},
					error: function(e){
						console.log("Error: " + e);
					}

				})


			});

	//****************************************************************************
			//create and open textarea to edit a comment
			$(document).on("click", ".quickreply2", function(e){


				e.preventDefault();
				var id = $(this).attr('name');
				console.log(id);
				console.log($("#"+id ).siblings(".content-box-content").text());

				var newcontent = "<form id='ContactForm'  method='post' onsubmit='return checkReplyForm();' action='editreply.php?complaint="+$(this).attr('name')+"'>";
				       newcontent += "<p><textarea class='myreply' name='message' rows='6' cols='82%' id='message'>"+$.trim($("#"+id ).siblings(".content-box-content").text())+"</textarea></p>";

				newcontent += "<p><input type='submit' value='SEND' class='button' /> &nbsp";
				newcontent += "<input type='reset' value='RESET' class='button' /></p></form>";


				//var id = $(this).attr('name');

				$("#"+id ).siblings( ".content-box-content").html(newcontent);
				//$("#"+id).html(newcontent);




			});

	//****************************************************************************

			//create and open textarea for a reply
			$(document).on("click", ".quickreply4", function(e){
			//$(".quickreply4").click(function(e) {

				e.preventDefault();

				createReply($(this).attr("name"));

			});

	//******************************************************************************
			//add new photos to a comment
			$(document).on("click", ".quickreply3", function(e){

				e.preventDefault();

				var newcontent = "<form action='upload_another_photo.php?id="+$(this).attr('name')+"' method='post' enctype='multipart/form-data' style='margin-bottom: 10px;text-align: center'>";

					newcontent += "<label style='vertical-align: middle' >Description: </label>";
					newcontent += "<input type='text' id='description' name='description' maxlength='65' style='width: 71%; margin-bottom: 10px; height: 25px;'>";
					newcontent += "<input type='file' name='file' id='file' style='width:75%;margin-right: 5px;'>";
					newcontent += "<input type='submit' name='UPLOAD' value='UPLOAD' class='button' title='Upload selected photo.'>";

				newcontent += "</form>";

				var id = $(this).attr('name');
				$("#"+id).html(newcontent);


			});

/*
			$(document).on("click", ".quickreply7", function(e){
				e.preventDefault();

				alert("ok");
			});
*/
	//********************************************************************************
			//4
			//edit a comment

			//Minimize Content Box
			$(document).on("mouseover", ".content-box-header", function(){// Give the Content Box Header a different cursor

				$(this).css("cursor","s-resize");

			});

	 /*
	 		$(".closed-box .content-box-content").hide(); // Hide the content of the header if it has the class "closed"
			$(".closed-box .content-box-tabs").hide(); // Hide the tabs in the header if it has the class "closed"
	 */
			$(document).on("click",".content-box-header .headerinfo" ,  // When the h3 is clicked...
					function () {
						$(this).parent().siblings().toggle(); // Toggle the Content Box

						//save in the database for this user.



						//$(this).siblings().toggleClass("closed-box"); // Toggle the class "closed-box" on the content box
						//$(this).parent().find(".content-box-tabs").toggle(); // Toggle the tabs
					});




	//*****************************************************************************************
			//change number of items per page
			$(document).on("change", "#itemperpageselect", function(e){
			//$("#itemperpageselect").change(function(e){
				e.preventDefault();

				$.ajax({
					type: "POST",
					url: "debate.php",
					data: { page: 1,items:$("#itemperpageselect").val()},

					success: function( result ) {

						$("#debate").html(result);

					}
				})

			});



	//**************************************************************************************************
			//change of page number
			$(document).on("click","#pagination a", function(e){
			//$("#pagination a").click(function(e){
				e.preventDefault();

				$.ajax({
					type: "POST",
					url: "debate.php",
					data: { page: $(this).attr('title'),items:$("#itemperpageselect").val()},

					success: function( result ) {

 					$("#debate").html(result);

					}
				});

			});

			//*********************************************************
			$(document).on("submit","#filter", function(e) {
				e.preventDefault();

				var from_date = $("#from_date").val();
				var to_date = $("#to_date").val();


				if(from_date < to_date) {

					$("#error").html("");

					$.ajax({
						type: "POST",
						url: "debate.php",
						data: {
							page: $(this).attr('title'),
							items: $("#itemperpageselect").val(),
							from_date: from_date,
							to_date: to_date
						},

						success: function (result) {

							$("#debate").html(result);

						}
					});
				}
				else
					$("#error").html("Check your intervals.");
			});

			//************************************************************
			$(document).on("reset","#filter", function(e) {
					e.preventDefault();

					$("#from_date").val("");
					$("#to_date").val("");
					$("#error").html("");

					$("#debate").load("debate.php"); //load initial records

			});













			//end document ready
		});




	</script>

</head>

<body id="page3">

<div class="loader"></div>

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
         <!-- -----------------------------------------------------------------------------   -->
         <!--left column -->
         <article class="col1">
          <h2><?php echo $history;?>:</h2>

			 <?php

			 if(isset($_GET['msg']))
			 {
				 $title = urldecode($_GET["msg"]);
				 echo "<h2 style='color: red;  font-size:16px; font-weight: 400;margin-left: 5px;'>".$title."</h2>";

			 }

			 ?>

			 <div id="debate">

			 </div>



            
          </article>
          <!-- -----------------------------------------------------------------------------   -->
          <!--right column -->
          <article class="col2 pad_left1"> 
        	 <?php
			  	include "right_menu.php";
			   // include "filtering.php";

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