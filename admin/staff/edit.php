<?php
	ob_start("ob_gzhandler"); //เรียกทุกหน้าแล้วตรงนี้เลยปิด
	header("Content-Encoding: gzip");
	header('Content-type: text/html; charset=utf-8');//Header to tell browser what kind of file it is.
	header("Cache-Control: must-revalidate");//Caching
	$offset = 60 * 60;
	$expire = "expires: " . gmdate ("D, d M Y H:i:s", time() + $offset) . " GMT";
	@header($expires);
	define( '_VALID_ACCESS', 1 );
	session_start();

	require_once( "../../configuration.php" );
	require_once( $_Config_absolute_path . "/includes/ms_com.php" );
	require_once( $_Config_absolute_path . "/includes/ms.class.php" );
	require_once( $_Config_absolute_path . "/includes/datetime.class.php" );
	require_once( $_Config_absolute_path . "/includes/func.class.php" );
	require_once( "../config_template.php" );

	//	#Admin Only
	if( empty($_SESSION['_LOGIN']) || empty($_SESSION['_GRPID']) || empty($_SESSION['_ID']) ||  $_SESSION['_GRPLEVEL'] != "Administrator"  ){
		mosRedirect("../_execlogout.php");
	}

	#Create Obj
	$DB = mosConnectADODB();
	$msObj = new MS($DB);

	$errCode= "0";
	$flagSuccess = "0";

	$action = trim(mosGetParam( $_FORM, 'action', ''));
	$id = trim(mosGetParam( $_FORM, 'id', ''));

	if( isset($action) && !empty($action) && $action == "แก้ไข | Edit" && eregi($_SERVER['HTTP_HOST'],$_SERVER['HTTP_REFERER']) ){

		$username = trim(mosGetParam($_FORM,'username'));
		$chk_password = mosGetParam( $_FORM, 'chk_password', '' );
		$password = trim(mosGetParam($_FORM,'password',''));
		$email = trim(mosGetParam($_FORM,'email',''));
		$status = trim(mosGetParam($_FORM,'status',''));
		$name = trim(mosGetParam($_FORM,'name',''));
		$group_id = trim(mosGetParam($_FORM,'group_id',''));


		$qryUpdate = "update $_Config_table[staff] set name =$DB->qstr('$name'), status= $DB->qstr('$status'), group_id=$DB->qstr('$group_id'), email=$DB->qstr('$email') ";
		if( $chk_password == "on" )
		{
			$qryUpdate .= ", password = MD5('$password')";
		}
		$qryUpdate .= ", UpdateDate = now() where staff_id = $id";
		$DB->Execute($qryUpdate);
		mosRedirect("index.php");

	}

	$qry="select * from $_Config_table[staff] where staff_id = '$id' ";
	$rs = $DB->Execute($qry);
	$row = $rs->FetchRow() ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$_Config_sitename?>'s Backoffice</title>
<link href="../css/css_bof.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../../js/jquery_ui/themes/base/jquery.ui.all.css">
<link rel="stylesheet" type="text/css" href="../../js/fancybox/jquery.fancybox.css" />
<!--<link href="css/css_template.css" rel="stylesheet" type="text/css" />-->
</head>
<body>
<?php include "../inc/headTag.tmpl.php";?>
<div id="SideMenu"><?php include "../inc/leftmenu.php";?></div>
<div id="Content">
	<h2>แก้ไขผู้ดูแลระบบ</h2>
  <div class="updated" id="Show-result"><p><span class="headSm">เกิดข้อผิดพลาด : </span><span class="date"><?php echo "รูปประกอบขนาดเล็ก : ".$errMsg; if($errMsg !="" && $errMsg2 !="" ){ echo ", "; } echo "รูปประกอบขนาดใหญ่ : ".$errMsg2;?></span></p></div>
    <form action="" method="post" enctype="multipart/form-data" name="FromEdit">
      <table class="form-table">
        <tbody>
          <tr class="form-field form-required">
            <th align="left" valign="top" scope="row"><label for="title">ชื่อผู้ใช้งาน</label></th>
            <td align="left" valign="top" class="idata"><input type="text" aria-required="true" size="40" id="name" name="name" value="<?php echo $row["name"]; ?>" /></td>
          </tr>
          <tr class="form-field">
            <th align="left" valign="top" scope="row"><label for="abstract">ชื่อในการเข้าสู่ระบบ</label></th>
            <td align="left" valign="top" class="idata"><input name="username" type="text" id="username" size="40" disabled="disabled" value="<?php echo clearText($row["username"]); ?>"/></td>
          </tr>
          <tr class="form-field">
            <th align="left" valign="top" scope="row">รหัสลับ</th>
            <td align="left" valign="top" class="idata"><input name="password" type="password" id="password" size="40" value="<?php echo clearText($row["password"]); ?>"/>
              <input name="chk_password" type="checkbox" id="chk_password" value="on" />
            Change password</td>
          </tr>
          <tr class="form-field">
            <th align="left" valign="top" scope="row">อีเมล์</th>
            <td align="left" valign="top" class="idata"><input name="email" type="text"  id="email" value="<?php echo clearText($row["email"]); ?>" size="40" /></td>
          </tr>
          <tr class="form-field">
            <th align="left" valign="top" scope="row">ระดับการเข้าถึง</th>
            <td align="left" valign="top" class="idata"><select name="group_id" id="group_id" >
              <option value="1" <?=($row["group_id"] == "1")? "selected" : ""?>>Administor</option>
              <option value="2" <?=($row["group_id"] == "2")? "selected" : ""?>>Staff</option>
              <?php if( $_SESSION['_GRPID'] == "88" ){ ?>
              <option value="88" <?=($row["group_id"] == "88")? "selected" : ""?>>8Webs Access Group</option>
              <?php } ?>
            </select></td>
          </tr>
          <tr class="form-field">
            <th align="left" valign="top" scope="row">สถานะ</th>
            <td align="left" valign="top" class="idata">
            <input name="status" type="radio" id="status" value="1" <?=($row["status"] == "1")? "checked" : ""?> /> เปิดให้ใช้งาน / Turn on user<br />
            <input type="radio" name="status" id="status" value="0" <?=($row["status"] == "0")? "checked" : ""?> /> ปิดให้ใช้งาน / Turn off user </td>
          </tr>
        </tbody>
      </table>
      <p class="submit">
    <input type="hidden" name="id" value="<?php echo $id;?>" />
    <input type="submit" value="แก้ไข | Edit" name="action" class="button-primary">
    <input type="button" name="action2" value="ยกเลิก | Cancel" class="button-primary" onclick="MM_goToURL('parent','index.php');return document.MM_returnValue" /></p>
    </form>
</div>
</body>
</html>
<script type='text/javascript' src='../../js/<?php echo $_Config_jquery_version;?>'></script>
<script type='text/javascript' src="../../js/jquery_ui/ui/jquery.ui.core.js"></script>
<script type='text/javascript' src="../../js/jquery_ui/ui/jquery.ui.widget.js"></script>
<script type='text/javascript' src="../../js/jquery_ui/ui/jquery.ui.accordion.js"></script>
<script type="text/javascript" src="../../js/fancybox/jquery.fancybox.js"></script>
<script type="text/javascript">

	jQuery(document).ready(function() {

		jQuery("a[rel=group]").fancybox({
			'transitionIn'		: 'true',
			'transitionOut'		: 'none',
			'padding'			: 1,
			'titleShow'	:	false
		});

	});

	<?php if($errCode != "0"){?>
	jQuery("#Show-result").slideDown(500).delay(10000).slideUp(500);
	<?php } ?>

	jQuery(function() {
		var icons = {
			header: "ui-icon-circle-arrow-e",
			headerSelected: "ui-icon-circle-arrow-s"
		};
		jQuery( "#AccordionMenu" ).accordion({
			icons: icons
		});
		jQuery( "#AccordionMenu" ).accordion( "option", "icons", icons );
	});

	jQuery('#checkAllAuto_Top, #checkAllAuto_Bottom').click(function(){
		var checkedValue = jQuery(this).attr('checked') ? 'checked' : '';
		jQuery(':checkbox').attr('checked', checkedValue);
	});

	jQuery('.row-title').live('mouseover', function(){
		var thisID = jQuery(this).attr('id');
		jQuery('.row-actions').hide();
		jQuery('#row-actions-'+thisID).show();
		jQuery('.row-title').live('mouseleave', function(){
			jQuery('#row-actions-'+thisID).hide();
		});
	});
</script>
