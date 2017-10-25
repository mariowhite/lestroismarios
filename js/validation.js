
//-------------------------------------------------------------------

function checkEmailForm()
{
	
	var name = document.getElementById("name").value;
	var pemail = document.getElementById("email").value;
	var psubject = document.getElementById("subject").value;
	var ptext = document.getElementById("message").value;
	
	if(name != "Your Name" && name!="" && pemail != "Your E-mail" && pemail!="" && psubject != "Subject" && psubject!="" && ptext != "Message" && ptext!= "")
	{
		
		//check correct emmail structure xxxxxx@xxxxx.xxx
		var atpos=pemail.indexOf("@");
		var dotpos=pemail.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=pemail.length)
  		{

			if(document.getElementById("lang").value == "SEND")
				alert("This email address is not valid, please try again.");
			else
				alert("Cette adresse email est pas valide, s'il vous plaît essayer à nouveau.");
  			return false;
  		}
		else
			return true;
		
	}
	else
	{
		if(document.getElementById("lang").value == "SEND")
			alert("The form must be completely filled out.");
		else
			alert("Le formulaire doit être rempli complètement.");
		return false;
		
	}
	
}
//-------------------------------------------------------------------
/*
function checkCommentForm()
{
	
	var psubject = document.getElementById("subject").value;
	var ptext = document.getElementById("message").value;
	
	if(psubject != "Subject" && psubject!="" && ptext != "Message" && ptext!= "")
		return true;
	else
	{
		
		alert("The form must be completely filled out.");
		return false;
	}
}

//---------------------------------------------------------------------------
function checkLoginForm()
{
	var user = document.getElementById("user").value;
	var password = document.getElementById("pwd").value;
	
	if(user != "Enter Your User Name" && user != "" &&  password != "" )
	{
		return true;
	}
	else
	{
		alert("The form must be completely filled out.");
		return false;	
	}
}

//-------------------------------------------------------------------
*/