
function change_to_EN()
{
  // this happens before the page changes
  setCookies("language", "en", 30);
  
}


function change_to_FR()
{
  // this happens before the page changes
  setCookies("language", "fr", 30);

}


function setCookies(c_name, value, exdays)
{
	var exdate = new Date();
	exdate.setDate(exdate.getDate() + exdays);

	var c_value = escape(value) + ((exdays == null) ? "" : "; expires="+exdate.toUTCString());

	//for the server in lestroismarios
	//document.cookie = c_name + " = " + c_value + "; domain=lestroismarios.com; path=/";

	//working on localhost
	document.cookie = c_name + " = " + c_value;

	console.log(document.cookie);


}