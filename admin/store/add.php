<?php
// Report all errors except E_NOTICE
//error_reporting(E_ALL & ~E_NOTICE);
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

$FU = new FU();
	$errCode= "0";
	$flagSuccess = "0";

	$action = trim(mosGetParam( $_FORM, 'action', ''));
	$id = trim(mosGetParam( $_FORM, 'id', ''));
    #=======================================================#
    $store_name = trim(mosGetParam($_FORM,'store_name'));
    $store_bill = trim(mosGetParam($_FORM,'store_bill',''));
    $store_bill_description = trim(mosGetParam($_FORM,'store_bill_description',''));


if( isset($action) && !empty($action) && $action == "บันทึก | Save"  ){


        #=======================================================#
        $sServerDir = $_Config_absolute_path."/uploads/store/";

        $sType = "Image";
        $SetMaxSize = '1048576';	// 1MB

        #Image Allowed & Denied
        $_Config['AllowedExtensions'][$sType] = array('jpg', 'jpeg', 'gif', 'png') ;
        $_Config['DeniedExtensions'][$sType] = array('zip', 'pdf', 'php','php3','php5','phtml','asp','aspx','ascx','jsp','cfm','cfc','pl','bat','exe','dll','reg','cgi') ;
        #=======================================================#

    $upload1 = $FU->uploadNewImage( $_FILES['file1'], $sServerDir, $_Config['AllowedExtensions'][$sType], $_Config['DeniedExtensions'][$sType], $SetMaxSize, 600);

        if($upload1["Flag"] == "1" ){//Error
            $errCode = "A100"; //Upload Failed
            $errMsg = $upload1["Msg"];
            $flagSuccess = "0";
        }else{

            #Get Last Order
            $qryGetOrder = "select store_order from $_Config_table[store] order by store_order desc limit 0, 1";
            $rsGetOrder = $DB->Execute($qryGetOrder);
            $getOrder = $rsGetOrder->FetchRow();
            $setOrder = $getOrder["store_order"] + 1;

            $qryInsPD = "INSERT INTO $_Config_table[store]
				(store_name,
                store_primary_img,
                store_bill,
                store_bill_description,
                createdate,
                updatedate,
                store_order)
			VALUES(
				$DB->qstr('$store_name'),
				'$upload1[sFileName]',
				$DB->qstr('$store_bill'),
				$DB->qstr('$store_bill_description'),
				now(), now(),
				$setOrder
			)";
            $qryInsPD2 = "INSERT INTO $_Config_table[store]
				(store_name,
                store_primary_img,
                store_bill,
                store_bill_description,
                createdate,
                updatedate,
                store_order)
			VALUES(
				$DB->qstr('$store_name'),
				'$upload1[sFileName]',
				$DB->qstr('$store_bill'),
				$DB->qstr('$store_bill_description'),
				now(), now(),
				$setOrder
			)";
            //echo $qryInsPD;
            //$DB->Execute($qryInsPD);

            /* Transection */
            /* อันนี้ */
            $acceptTran = $DB->Execute($qryInsPD);  //ไม่ต้อง insert เพราะเราทำเงื่อนไข ขึั้นต่อไป
            $ProductID = $DB->Insert_ID();
            //if ($acceptTran) $acceptTran = $DB->Execute($qryInsPD);
            if (!$acceptTran) {
                $DB->RollbackTrans();
                echo "Error Save [".$qryInsPD."]";
            } else{
                $flagCommit1 = $DB->CommitTrans();
            }

            $flagSuccess1 = $flagCommit1; //เปลี่ยนเป็น $flagCommit

            if( $flagSuccess1 == "1" ){
                mosRedirect("index.php");
            }
        }
        //mosRedirect( "index.php" );
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
	<h2>เพิ่มร้านค้า</h2>
<div class="updated" id="Show-result"><p><span class="headSm">เกิดข้อผิดพลาด : </span><span class="date"><?php echo "รูปประกอบขนาดเล็ก : ".$errMsg; if($errMsg !="" && $errMsg2 !="" ){ echo ", "; } echo "รูปประกอบขนาดใหญ่ : ".$errMsg2;?></span></p></div>
    <form action="" method="post" enctype="multipart/form-data" name="FromEdit">
    <table class="form-table">
            <tbody>


              <tr class="form-field">
                <th align="left" valign="top" scope="row">ชื่อร้าน</th>
                  <td align="left" valign="top" class="idata"><input name="store_name" type="text"  id="store_name" size="60" value="<?php echo $store_name; ?>" /></td>
              </tr>
                <tr class="form-field">
                    <th align="left" valign="top" scope="row">รูปประกอบขนาดเล็ก</th>
                    <td align="left" class="idata"><input type="file" name="file1" id="file1" /><br />
                        <span class="description">ขนาดความกว้างไม่เกิน 600px พิกเซล ขนาดไฟล์ไม่เกิน 1 MB. (อนุญาติเฉพาะไฟล์ .gif .jpg .jpeg .png เท่านั้น)</span></td>
                </tr>
              <tr class="form-field">
                <th align="left" valign="top" scope="row">จำนวนรหัสใบเสร็จ</th>
                  <td align="left" valign="top" class="idata"><input name="store_bill" type="text"  id="store_bill" size="60" value="<?php echo $store_bill; ?>" /></td>
              </tr>

              <tr class="form-field">
                <th align="left" valign="top" scope="row">รายละเอียดใบเสร็จ</th>
                <td align="left" valign="top" class="idata">
                    <textarea style="width: 97%;" cols="50" rows="5" id="store_bill_description" name="store_bill_description"><?php echo $store_bill_description; ?></textarea>
                </td>
              </tr>


          </tbody>
    </table>
    <p class="submit">
    <input type="hidden" name="oldThumb" value="<?php echo $row["avatar"];?>" />
    <input type="hidden" name="id" value="<?php echo $id;?>" />
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
