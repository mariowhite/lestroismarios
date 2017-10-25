// JavaScript Document

function checkReplyForm()
{
	
	var ptext = document.getElementById("message").value;
	
	if(ptext != "Message" && ptext!= "")
		return true;
	else
	{
		
		alert("The form must be completely filled out.");
		return false;
	}
}

function clearMessage(obj)
{

	if(obj.value  == "Message") 
	{ 
		obj.value = "";
	}

}

function fillMessage(obj)
{
	if(obj.value == "") 
	{ 
		obj.value = "Message";
	}
}


function createReply(idcomplaint)
{
		var newcontent = "<form id='ContactForm'  method='post' onsubmit='return checkReplyForm();' action='newreply.php?complaint="+idcomplaint+"'>";
			newcontent += "<p><textarea class='myreply' name='message' rows='6' cols='82%' id='message' onfocus='clearMessage(this);' ";
            newcontent += " onblur='fillMessage(this);' >Message</textarea></p>";
            
			newcontent += "<p><input type='submit' value='SEND' class='button' /> &nbsp";
			newcontent += "<input type='reset' value='RESET' class='button' /></p></form>";
			
			
			document.getElementById(idcomplaint.toString()).innerHTML = newcontent;
			
}

//calendar functions

function activateCalendar()
{
	if(document.getElementById("filter").checked)
	{
		document.getElementById("from_date").disabled = false;
		document.getElementById("to_date").disabled = false;
		
	}
	else
	{
		document.getElementById("from_date").disabled=true;
		document.getElementById("to_date").disabled=true;	
		
		document.getElementById("from_date").value="";
		document.getElementById("to_date").value="";	
	}
}


function checkDate()
{
		
	var from = new Date(document.getElementById("from_date").value);
	var to = new Date(document.getElementById("to_date").value);
	
	if(from < to)
	{
		return true;
	}
	else
	{
		document.getElementById("filter").checked = true;
		document.getElementById("error").innerHTML  = "Check your intervals.";
		return false;
	}
}