// JavaScript Document
<!--
//Browser Support Code
//function checkusername()
//{
//	var ajaxRequest;
//
//	if (window.XMLHttpRequest)
//	{
//		// For Netscape, FireFox and not IE
//          		ajaxRequest = new XMLHttpRequest();
//	}
//	else if(window.ActiveXObject)
//	{
//		// For IE
//          		ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
//	}
//	else
//	{
//		alert("Browser error");
//		return false;
//	}
//
//	ajaxRequest.onreadystatechange = function()
//	{
//		if(ajaxRequest.readyState == 4)
//		{
//			var area = document.getElementById('divinfo');
//			area.innerHTML = ajaxRequest.responseText;
//		}
//		else {
//			var area = document.getElementById('divinfo');
//			area.innerHTML = "<img src=images/indicatp.gif>";
//		}
//	}
//	var username = document.frm_register.username.value;
//
//	ajaxRequest.open(	"GET", "checkusername.php?" + "username=" + username , true);
//
//	ajaxRequest.send(null);
//}
//-->
//function checksubdomain()
//{
//	var ajaxRequest;
//
//	if (window.XMLHttpRequest)
//	{
//		// For Netscape, FireFox and not IE
//          		ajaxRequest = new XMLHttpRequest();
//	}
//	else if(window.ActiveXObject)
//	{
//		// For IE
//          		ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
//	}
//	else
//	{
//		alert("Browser error");
//		return false;
//	}
//
//	ajaxRequest.onreadystatechange = function()
//	{
//		if(ajaxRequest.readyState == 4)
//		{
//			var area = document.getElementById('divurl');
//			area.innerHTML = ajaxRequest.responseText;
//		}
//	}
//	var subdomain = document.frm_register.subdomain.value;
//
//	ajaxRequest.open(	"GET", "checksubdomain.php?" + "subdomain=" + subdomain , true);
//
//	ajaxRequest.send(null);
