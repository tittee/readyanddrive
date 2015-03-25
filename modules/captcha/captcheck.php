<?
// continue the session so we can access the session variable
session_start();

/*
		function alert_mesg($message) {
			echo "<script language='javascript'>" ;
			echo "alert('$message')" ;
			echo "</script>" ;
		} // alert

		// Make posted code into upper case, then compare with the stored string
		alert_mesg($_GET['code']);
		alert_mesg($_SESSION['secret_string']);
*/

if($_GET['code'] != $_SESSION['secret_string'])
{
  echo '0';  // failed
} else {
  echo '1';  // passed
}

?>
