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
$DT = new DT();
	$errCode= "0";
	$flagSuccess = "0";

	$id = trim(mosGetParam( $_FORM, 'id', ''));

$qry="select * from $_Config_table[store] where store_id = '$id' ";
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
    <h2>รายละเอียดร้าน</h2>
<div class="updated" id="Show-result"><p><span class="headSm">เกิดข้อผิดพลาด : </span><span class="date"><?php echo "รูปประกอบขนาดเล็ก : ".$errMsg; if($errMsg !="" && $errMsg2 !="" ){ echo ", "; } echo "รูปประกอบขนาดใหญ่ : ".$errMsg2;?></span></p></div>
    <form action="" method="post" enctype="multipart/form-data" name="FromEdit">
        <table class="form-table">
            <tbody>

                <tr class="form-field">
                    <th align="left" valign="top" scope="row">ชื่อร้าน</th>
                    <td align="left" valign="top" class="idata"><?php echo $row['store_name']; ?></td>
                </tr>


                <tr class="form-field" >
                    <th valign="top" scope="row">รูปประกอบขนาดเล็ก</th>
                    <td class="idata">
                        <img src="<?php echo "../../uploads/store/".$row["store_primary_img"]; ?>" class="border" /></td>
                </tr>
                <tr class="form-field">
                    <th align="left" valign="top" scope="row">จำนวนรหัสใบเสร็จ</th>
                    <td align="left" valign="top" class="idata"><?php echo $row['store_bill']; ?></td>
                </tr>

                <tr class="form-field">
                    <th align="left" valign="top" scope="row">รายละเอียดใบเสร็จ</th>
                    <td align="left" valign="top" class="idata">
                        <?php echo $row['store_bill_description']; ?>
                    </td>
                </tr>
                <tr class="form-field">
                    <th align="left" valign="top" scope="row">วันที่สร้าง</th>
                    <td align="left" valign="top" class="idata">
                        <?php echo ($DT->isDate($row["createdate"]))? $DT->DateTimeShortFormat($row["createdate"], 0, 0, "Th") : "-" ;?>
                    </td>
                </tr>

                 <tr class="form-field">
                    <th align="left" valign="top" scope="row">วันที่แก้ไข</th>
                    <td align="left" valign="top" class="idata">
                        <?php echo ($DT->isDate($row["updatedate"]))? $DT->DateTimeShortFormat($row["updatedate"], 0, 0, "Th") : "-" ;?>
                    </td>
                </tr>

            </tbody>
        </table>
    <p class="submit">
    <input type="button" value="แก้ไข | Edit" name="action" class="button-primary" onclick="MM_goToURL('parent','edit.php?id=<?php echo $id;?>');return document.MM_returnValue">
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
