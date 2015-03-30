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
	require_once( $_Config_absolute_path . "/modules/ckeditor/ckeditor.php");
	require_once( $_Config_absolute_path . "/modules/cke_config.php");
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

	if( isset($action) && !empty($action) && $action == "บันทึก | Save" && eregi($_SERVER['HTTP_HOST'],$_SERVER['HTTP_REFERER']) ){

		$username = trim(mosGetParam($_FORM,'username'));
		$password = trim(mosGetParam($_FORM,'password',''));
		$email = trim(mosGetParam($_FORM,'email',''));
		$status = trim(mosGetParam($_FORM,'status',''));
		$name = trim(mosGetParam($_FORM,'name',''));
		$group_id = trim(mosGetParam($_FORM,'group_id',''));

		$qryCheck = "select * from $_Config_table[staff]  where username = '$username'";
		$rsCheck = $DB->Execute($qryCheck);
		if($rsCheck->RecordCount() > 0){
			echo FU::alert_mesg("ไม่สามารถดำเนินการได้ เนื่องจากมีผู้ใช้ login นี้แล้ว กรุณาบันทึกใหม่");
		}else{
			$qryIns = "insert into $_Config_table[staff](
			username, password, email, status, name, group_id, UpdateDate, CreateDate)
			values($DB->qstr('$username'), MD5('$password'), $DB->qstr('$email'), $DB->qstr('$status'),
			$DB->qstr('$name'), $DB->qstr('$group_id'), now(), now())";

			$DB->Execute($qryIns);
			mosRedirect("index.php");
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$_Config_sitename?>'s Backoffice</title>
<link href="../css/css_bof.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../../js/jquery_ui/themes/base/jquery.ui.all.css">
<!--<link href="css/css_template.css" rel="stylesheet" type="text/css" />-->
</head>
<body>
<?php include "../inc/headTag.tmpl.php";?>
<div id="SideMenu"><?php include "../inc/leftmenu.php";?></div>
<div id="Content">
	<h2>เพิ่มผู้ดูแลระบบ</h2>
<div class="updated" id="Show-result"><p><span class="headSm">เกิดข้อผิดพลาด : </span><span class="date"><?php echo "รูปประกอบขนาดเล็ก : ".$errMsg; if($errMsg !="" && $errMsg2 !="" ){ echo ", "; } echo "รูปประกอบขนาดใหญ่ : ".$errMsg2;?></span></p></div>
    <form action="" method="post" enctype="multipart/form-data" name="FromAdd">
    <table class="form-table">
            <tbody><tr class="form-field form-required">
                <th align="left" valign="top" scope="row"><label for="title">ชื่อผู้ใช้งาน</label></th>
              <td align="left" valign="top" class="idata"><input type="text" aria-required="true" size="40" id="name" name="name" value="<?php echo $name; ?>"></td>
            </tr>
            <tr class="form-field">
                <th align="left" valign="top" scope="row"><label for="abstract">ชื่อในการเข้าสู่ระบบ</label></th>
              <td align="left" valign="top" class="idata"><input name="username" type="text" id="username" size="40" /></td>
            </tr>
            <tr class="form-field">
              <th align="left" valign="top" scope="row">รหัสลับ</th>
              <td align="left" valign="top" class="idata"><input name="password" type="password" id="password" size="40" /></td>
            </tr>
            <tr class="form-field">
              <th align="left" valign="top" scope="row">อีเมล์</th>
              <td align="left" valign="top" class="idata"><input name="email" type="text"  id="email" value="<?php echo $email; ?>" size="40" /></td>
            </tr>
            <tr class="form-field">
              <th align="left" valign="top" scope="row">ระดับการเข้าถึง</th>
              <td align="left" valign="top" class="idata">
              <select name="group_id" id="group_id" >
                <option value="1" >Administor</option>
                <option value="2"  >Staff</option>
                <?php if( $_SESSION['_GRPID'] == "88" ){ ?>
                <option value="88">8Webs Access Group</option>
                <?php } ?>
            </select></td>
            </tr>

            <tr class="form-field">
              <th align="left" valign="top" scope="row">สถานะ</th>
              <td align="left" valign="top" class="idata">
              <input name="status" type="radio" id="status" value="1" <?php if($status == "" || $status == "1"){ echo "checked"; }?> />
                เปิดให้ใช้งาน / Turn on user<br />
              <input type="radio" name="status" id="status" value="0" <?php if($status == "0"){ echo "checked"; }?> />
              ปิดให้ใช้งาน / Turn off user </td>
            </tr>
          </tbody>
    </table>
    <p class="submit">
    <input type="submit" value="บันทึก | Save" name="action" class="button-primary">
    <input type="button" name="action2" value="ยกเลิก | Cancel" class="button-primary" onclick="MM_goToURL('parent','index.php');return document.MM_returnValue" /></p>
    </form>
</div>
</body>
</html>
<script type='text/javascript' src='../../js/<?php echo $_Config_jquery_version;?>'></script>
<script type='text/javascript' src="../../js/jquery_ui/ui/jquery.ui.core.js"></script>
<script type='text/javascript' src="../../js/jquery_ui/ui/jquery.ui.widget.js"></script>
<script type='text/javascript' src="../../js/jquery_ui/ui/jquery.ui.accordion.js"></script>
<script type="text/javascript">

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
