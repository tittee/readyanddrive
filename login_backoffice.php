<?php
	// Turn on all error reporting
	//error_reporting(1);

	session_start();

	/** Set flag that this is a parent file */
	define( '_VALID_ACCESS', 1 );

	require_once( "globals.php" );
	require_once( "configuration.php" );
	require_once( $_Config_absolute_path . "/includes/ms_com.php" );
	require_once( $_Config_absolute_path . "/includes/ms.class.php" );
	require_once( $_Config_absolute_path . "/includes/datetime.class.php" );

	$DB = mosConnectADODB();
	$msObj = new MS($DB);

	$msg = "";

	$action = mosGetParam( $_FORM, 'action', '' );

	if( isset($action) && !empty($action) && $action == "Login_Bof" && eregi($_SERVER['HTTP_HOST'],$_SERVER['HTTP_REFERER']) ){

		$loginname 	= trim( mosGetParam( $_POST, 'giFormUsername', '' ) );
		$loginpwd 	= trim( mosGetParam( $_POST, 'giFormPassword', '' ) );

		$validUrl = "admin/index.php";
		$invalidUrl = "login_backoffice.php";

		if( !empty($loginname) && !empty($loginpwd)){

			$qryChk = "select * from $_Config_table[staff]
			           where username = '$loginname' and password = MD5('$loginpwd') and status='1'";
			echo $qryChk;
			$rsChk = $DB->Execute($qryChk);
			if (!$result) 	print $DB->ErrorMsg();

			if( $rsChk->RecordCount()){
				$chkuser = $rsChk->FetchRow();

				$_SESSION['_ID'] = $chkuser["staff_id"];
				$_SESSION['_LOGIN'] = $chkuser["username"];
				$_SESSION['_GRPID'] = $chkuser["group_id"]; 	//1=Admin, 2=Staff
				$_SESSION['_GRPLEVEL'] = ($_SESSION['_GRPID']=="1" || $_SESSION['_GRPID']=="88")? "Administrator" : "Officer";
				$_SESSION['_LASTLOGIN'] = $chkuser["lastlogin"];

				$qryUpdate = "update $_Config_table[staff] set lastlogin = now() where staff_id = '$chkuser[staff_id]' ";
				$rs = $DB->Execute($qryUpdate);

				mosRedirect( $validUrl);

			}else{
				$msg = 'Invalid the username and password to gain access to the backend';
			}
		}
	}
	$errCode="0";
    //$rowVarMain = $msObj->getVarMain(); //ดึงค่าหลักประจำเว็บ เช่น รูป bg,รูป header , keyword ต่างๆ
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login to Backoffice Management System. </title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #69696a;
}
.txt_1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
	color: #999;
}
.txt_2 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: normal;
	color: #999;
	text-decoration: none;
}
.txt_3 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #69696A;
}
.form {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #69696A;
	background-color: #eeeeee;
	height: 22px;
	border-top-width: 1px;
	border-top-style: solid;
	border-top-color: #999;
	border-right-color: #999;
	border-bottom-color: #999;
	border-left-color: #999;
	border-right-width: 0px;
	border-bottom-width: 0px;
	border-left-width: 0px;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
	vertical-align: middle;
	background-position: center;
}
.errText {
	color: #F00;
	font-size: 10px;
	font-family: Verdana;
	font-weight: bold;
}
-->
</style>
	<SCRIPT language=javascript type=text/javascript>
	function setFocus() {
		document.loginForm.giFormUsername.select();
		document.loginForm.giFormUsername.focus();
	}
	</SCRIPT>
</head>

<body onLoad="setFocus()">
<table width="100%"  height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="middle"><table width="40%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="9%" height="35" align="center"><img src="images/images_backoffice/key_backoffice.jpg" width="16" height="22" /></td>
            <td width="91%" nowrap="nowrap" class="txt_1">Login to Backoffice Management System. </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="14"><img src="images/images_backoffice/borlog_1.jpg" width="14" height="14" /></td>
            <td background="images/images_backoffice/borlog_2.jpg"><img src="images/images_backoffice/borlog_2.jpg" width="14" height="14" /></td>
            <td width="14"><img src="images/images_backoffice/borlog_3.jpg" width="14" height="14" /></td>
          </tr>
          <tr>
            <td background="images/images_backoffice/borlog_4.jpg"><img src="images/images_backoffice/borlog_4.jpg" width="14" height="14" /></td>
            <td valign="middle" bgcolor="#FFFFFF">
              <table width="100%" border="0" cellspacing="0" cellpadding="15">
                <form id="loginForm" name="loginForm" method="post" class="appnitro" action="login_backoffice.php"
			onSubmit="with(document.loginForm){
				if(giFormUsername.value==''){ alert('Please insert your username '); giFormUsername.focus(); return false; }
				if(giFormPassword.value==''){ alert('Please insert your password '); giFormPassword.focus(); return false; }
			}
			">
            	<tr>
                  <td align="center" valign="middle"><img src="uploads/<?php echo $rowVarMain[site_logo];?>" border="0" /></td>
                  <td valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="1"  height="190px"bgcolor="#CCCCCC"><img src="images/images_backoffice/space.gif" width="1" height="5" /></td>
                    </tr>
                  </table></td>
                  <td valign="middle"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td class="errText"><?php echo (!empty($msg))? $msg : "&nbsp;"; ?></td>
                    </tr>
                    <tr>
                      <td height="20" class="txt_3">Username :</td>
                    </tr>
                    <tr>
                      <td><input name="giFormUsername" type="text" class="form" id="giFormUsername" size="30" /></td>
                    </tr>
                    <tr>
                      <td height="20" class="txt_3">Password :</td>
                    </tr>
                    <tr>
                      <td><input name="giFormPassword" type="password" class="form" id="giFormPassword" size="30" /></td>
                    </tr>
                    <tr>
                      <td height="20" nowrap class="txt_2">Please enter username and password.</td>
                    </tr>
                    <tr>
                      <td align="right">
                      <input type="hidden" name="action" value="Login_Bof" />
                      <input type="image" name="imageField" id="imageField" src="images/images_backoffice/btt_login_backoffice.jpg" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                  </table></td>
                </tr>
              </form></table>
            </td>
            <td background="images/images_backoffice/borlog_5.jpg"><img src="images/images_backoffice/borlog_5.jpg" width="14" height="14" /></td>
          </tr>
          <tr>
            <td><img src="images/images_backoffice/borlog_6.jpg" width="14" height="14" /></td>
            <td background="images/images_backoffice/borlog_7.jpg"><img src="images/images_backoffice/borlog_7.jpg" width="14" height="14" /></td>
            <td><img src="images/images_backoffice/borlog_8.jpg" width="14" height="14" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="50%" height="20" class="txt_2">Developed by <a href="http://www.zoftwin.com" target="_blank" class="txt_2">zoftwin.com</a></td>
            <td width="50%" align="right"><a href="index.php" class="txt_2">Go to Your Homepage &gt;</a></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
