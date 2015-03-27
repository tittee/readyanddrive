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

	#Login ?
	if( empty($_SESSION['_LOGIN']) || empty($_SESSION['_GRPID']) || empty($_SESSION['_ID'])){
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

        $member_fname = trim(mosGetParam($_FORM,'member_fname'));
        $member_lname = trim(mosGetParam($_FORM,'member_lname',''));
        $password = trim(mosGetParam($_FORM,'password',''));
        $member_email = trim(mosGetParam($_FORM,'member_email',''));
        $member_gender = trim(mosGetParam($_FORM,'member_gender',''));
        $member_province = trim(mosGetParam($_FORM,'member_province',''));
        $member_mobileno = trim(mosGetParam($_FORM,'member_mobileno',''));
        $member_backlist = trim(mosGetParam($_FORM,'member_backlist',''));

        $qry_check = "select * from $_Config_table[member]  where member_id = '$id' ";
        $rs_check = $DB->Execute($qry_check);
        $row_check = $rs_check->FetchRow();



        $qryUpdate = "update  $_Config_table[member] set
            member_fname = $DB->qstr('$member_fname'),
            member_lname = $DB->qstr('$member_lname'),
            member_email = $DB->qstr('$member_email'),
            member_gender = $DB->qstr('$member_gender'),
            member_province = $DB->qstr('$member_province'),
            zipcode = $DB->qstr('$zipcode'),
            member_mobileno = $DB->qstr('$member_mobileno'),
            member_create_date = now(),
            member_update_date = now(),
            member_backlist = $DB->qstr('$member_backlist') ";
            if( $chk_password == "on" ){
                $qryUpdate.= ", password  = $DB->qstr('$password') ";
            }
			$qryUpdate.=" where member_id='$id' ";

			$DB->Execute($qryUpdate);
			$flagSuccess = "1";
            //echo $qryUpdate;

            mosRedirect( "index.php" );
		}



    $qry="select * from $_Config_table[member] where member_id = '$id' ";
	$rs = $DB->Execute($qry);
	$row = $rs->FetchRow();

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
	<h2>แก้ไขสมาชิก</h2>
<div class="updated" id="Show-result"><p><span class="headSm">เกิดข้อผิดพลาด : </span><span class="date"><?php echo "รูปประกอบขนาดเล็ก : ".$errMsg; if($errMsg !="" && $errMsg2 !="" ){ echo ", "; } echo "รูปประกอบขนาดใหญ่ : ".$errMsg2;?></span></p></div>
    <form action="" method="post" enctype="multipart/form-data" name="FromEdit">
    <table class="form-table">
            <tbody>
             <!--<tr class="form-field form-required">
              <th align="left" valign="top" scope="row"><label for="title">ชื่อการใช้งาน</label></th>
                <td align="left" valign="top" class="idata"><?php echo $row["username"]; ?></td>
            </tr>-->
            <!--<tr class="form-field">
                <th align="left" valign="top" scope="row">รหัสผ่าน</th>
                <td align="left" valign="top" class="idata">
                <input name="password" type="password" id="password_member" size="15" maxlength="15" value="<?=$row["password"]?>"  />
                <input name="chk_password" type="checkbox" id="chk_password" value="on" />
                เปลี่ยนรหัสผ่าน<br />
                <span class="description">ถ้าต้องการเปลี่ยนแปลงรหัสผ่านให้เลือกที่ เปลี่ยนแปลงรหัสผ่าน และใส่รหัสผ่านใหม่ที่ท่านต้องการ</span></td>
              </tr>-->

              <tr class="form-field">
                <th align="left" valign="top" scope="row">ชื่อ</th>
                <td align="left" valign="top" class="idata"><input name="member_fname" type="text"  id="member_fname" size="60" value="<?php echo clearText($row["member_fname"]); ?>" /></td>
              </tr>
              <tr class="form-field">
                <th align="left" valign="top" scope="row">นามสกุล</th>
                <td align="left" valign="top" class="idata"><input name="member_lname" type="text"  id="member_lname" size="60" value="<?php echo clearText($row["member_lname"]); ?>" /></td>
              </tr>

              <tr class="form-field">
                <th align="left" valign="top" scope="row">เพศ</th>
                <td align="left" valign="top" class="idata">
                <input type='radio' name='member_gender' id="member_gender" value='0' <? if ($row["member_gender"] == '0'){ echo "checked='checked'";}?> /> ชาย (Male)
                <input type='radio' name='member_gender' id="member_gender" value='1' <? if ($row["member_gender"] == '1'){ echo "checked='checked'";}?> /> หญิง (Female)</td>
              </tr>

                <tr class="form-field">
                    <th align="left" valign="top" scope="row">อีเมล์</th>
                    <td align="left" valign="top" class="idata"><input name="member_email" type="text" id="member_email" size="60" value="<?php echo clearText($row["member_email"]); ?>" /></td>
                </tr>
                <tr class="form-field">
                    <th align="left" valign="top" scope="row">โทรศัพท์</th>
                    <td align="left" valign="top" class="idata"><input name="member_mobileno" type="text" id="member_mobileno" size="9" maxlength="20" value="<?=$row["member_mobileno"]?>" /></td>
                </tr>
              <tr class="form-field">
                <th align="left" valign="top" scope="row">จังหวัด</th>
                <td align="left" valign="top" class="idata">
                <select  id="member_province" name="member_province">
        		<option value="" selected="selected">--เลือก/select--</option>
                    <?php $msObj->selectOptionNoTag($_Config_table["province"], "province_id", "province_name", $row["member_province"]);?>
                </select></td>
              </tr>


              <tr class="form-field">
                <th align="left" valign="top" scope="row">บัญชีอันตราย</th>
                <td align="left" valign="top" class="idata">
                    <input name="member_backlist" type="radio" id="member_backlist" value="1" <?php echo ($row["member_backlist"]=="1")? "checked" : ""; ?> />
                ใช่ / Yes <br />
                    <input type="radio" name="member_backlist" id="member_backlist" value="0" <?php echo ($row["member_backlist"]=="0")? "checked" : ""; ?> />
                ไม่/ No </td>
              </tr>

          </tbody>
    </table>
    <p class="submit">
    <input type="hidden" name="oldThumb" value="<?php echo $row["avatar"];?>" />
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
