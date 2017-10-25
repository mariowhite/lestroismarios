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


    //General user
    echo "<h2>".$options.":</h2>";
    echo "<a class='hvr-underline-from-left' href='writecomment.php' id='services'>".$write."</a></br>";
    echo "<a class='hvr-underline-from-left' href='completecalendar.php' id='services'>".$checkcalendar."</a></br></br>";

    echo "<h2>".$account.":</h2>";
    echo "<a class='hvr-underline-from-left' href='edit_user_field.php?user=".$_SESSION['user']."' id='services'>".$myaccount."</a></br></br>";



if ($_SESSION['type']== "Director")
{

    //admin user
    echo "<h2>".$admin.":</h2>";

    echo "<a class='hvr-underline-from-left' href='addnewuser.php' id='services'>".$add_user."</a></br>
		  <a class='hvr-underline-from-left' href='edit_user.php' id='services'>".$list_users."</a></br>



		 <a class='hvr-underline-from-left' href='add_contracts.php' id='services'>".$add_contract."</a></br>
		 <a class='hvr-underline-from-left' href='edit_contract.php' id='services'>".$list_contract."</a></br>



		 <a class='hvr-underline-from-left' href='connect_users_contracts.php' id='services'>".$connect."</a></br>




		 <a class='hvr-underline-from-left' href='list_user_contracts.php' id='services'>".$title_users_contracts."</a></br>
		 <a class='hvr-underline-from-left' href='list_contracts_users.php' id='services'>".$title_contracts_users."</a></br>

		 ";



}

include "calendar.php";

?>

