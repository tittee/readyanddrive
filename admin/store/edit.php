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

#Login ?
if( empty($_SESSION['_LOGIN']) || empty($_SESSION['_GRPID']) || empty($_SESSION['_ID'])){
    mosRedirect("_execlogout.php");
}

#Create Obj
$DB = mosConnectADODB();
$msObj = new MS($DB);

$DB->BeginTrans(); /* Transection Start */

$errCode= "0";
$flagSuccess = "0";

$action = trim(mosGetParam( $_FORM, 'action', ''));
$id = trim(mosGetParam( $_FORM, 'id', ''));

#Detail
$store_name = trim(mosGetParam($_FORM,'store_name'));
$store_bill = trim(mosGetParam($_FORM,'store_bill',''));
$store_bill_description = trim(mosGetParam($_FORM,'store_bill_description',''));

#image
$oldThumb = trim(mosGetParam($_FORM,'oldThumb',''));
if( isset($action) && !empty($action) && $action == "แก้ไข | Edit" && eregi($_SERVER['HTTP_HOST'],$_SERVER['HTTP_REFERER']) ){



    #=======================================================#

    $sServerDir = $_Config_absolute_path."/uploads/store/";

    $sType = "Image";
    $SetMaxSize = '1048576';	// 1MB

    #Image Allowed & Denied
    $_Config['AllowedExtensions'][$sType] = array('jpg', 'jpeg', 'gif', 'png') ;
    $_Config['DeniedExtensions'][$sType] = array('zip', 'pdf', 'php','php3','php5','phtml','asp','aspx','ascx','jsp','cfm','cfc','pl','bat','exe','dll','reg','cgi') ;
    #=======================================================#

    $upload1 = @FU::uploadEditImage( $_FILES['file1'], $sServerDir, $_Config['AllowedExtensions'][$sType], $_Config['DeniedExtensions'][$sType], $SetMaxSize, 600, $oldThumb);

    if($upload1["Flag"] == "1" ){//Error
        $errCode = "A100"; //Upload Failed
        $errMsg = $upload1["Msg"];
        $flagSuccess = "0";
    }else{


        $qryUpdatePD2 = "UPDATE store SET
			  store_name = $DB->qstr('$store_name'),
			  store_primary_img = '$upload1[sFileName]',
			  store_bill = $DB->qstr('$store_bill'),
			  store_bill_description = $DB->qstr('$store_bill_description'),
			  updatedate = now()
			WHERE store_id='$id' ";

        $qryUpdatePD =  "UPDATE store SET
			  store_name = $DB->qstr('$store_name'),
			  store_primary_img = '$upload1[sFileName]',
			  store_bill = $DB->qstr('$store_bill'),
			  store_bill_description = $DB->qstr('$store_bill_description'),
			  updatedate = now()
			WHERE store_id='$id' ";

        /*$qryUpdatePD;
			$DB->Execute($qryUpdatePD);
			$flagSuccess = "1";*/
        $acceptTran = $DB->Execute($qryUpdatePD);
        //if ($acceptTran) $acceptTran = $DB->Execute($qryUpdatePD);
        if (!$acceptTran) {
            $DB->RollbackTrans();
            echo "Error Save [".$qryUpdatePD."]";
        }else{
            $flagCommit1 = $DB->CommitTrans();
            //-----------------------------------------------------------//
        }

        $flagSuccess1 = $flagCommit1; //เปลี่ยนเป็น $flagCommit

        if( $flagSuccess1 == "1" ){
            mosRedirect("index.php");
        }
    }

}

$qryPD = "select * from $_Config_table[store] where store_id = '$id' ";
$rsPD = $DB->Execute($qryPD);
$row = $rsPD->FetchRow() ;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?=$_Config_sitename?>'s Backoffice</title>
        <link href="../css/css_bof.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../../js/jquery_ui/themes/base/jquery.ui.all.css">
        <link rel="stylesheet" type="text/css" href="../../js/fancybox/jquery.fancybox.css" />
        <link href="../css/idTabs.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <?php include "../inc/headTag.tmpl.php";?>
        <div id="SideMenu"><?php include "../inc/leftmenu.php";?></div>
        <div id="Content">
            <h2>แก้ไขสินค้า</h2>
            <div class="updated" id="Show-result"><p><span class="headSm">เกิดข้อผิดพลาด : </span>
                <span class="date">
                    <?php
if($errMsg != "" ) echo "รูปประกอบขนาดเล็ก : ".$errMsg;
if($errMsg != "" && $errMsg3 !="") echo ", ";
echo "รูปประกอบขนาดกลาง : ".$errMsg3;
if($errMsg != "" && $errMsg3 !="" && $errMsg2 !="") echo ", ";
echo "รูปประกอบขนาดใหญ่ : ".$errMsg2;
                    ?>

                </span></p></div>
            <!--<form action="" method="post" enctype="multipart/form-data" name="FromEdit">-->
            <form action="" method="post" id="FromEdit" enctype="multipart/form-data" name="FromEdit" onSubmit=" return checkForm(); ">

                <table class="form-table">
                            <tbody>

                                <tr class="form-field">
                                    <th align="left" valign="top" scope="row">ชื่อร้าน</th>
                                    <td align="left" valign="top" class="idata"><input name="store_name" type="text"  id="store_name" size="60" value="<?php echo $row['store_name']; ?>" /></td>
                                </tr>



                                <tr class="form-field" >
                                    <th valign="top" scope="row">รูปประกอบขนาดเล็ก</th>
                                    <td class="idata"><input type="file" name="file1" id="file1" />
                                        <br />
                                        <?php if( !empty($row["store_primary_img"])){ ?>
                                        <table width="74" border="0">
                                            <tr>
                                                <td align="center"><img src="<?php echo "../../uploads/store/".$row["store_primary_img"]; ?>" class="border" /></td>
                                            </tr>

                                            <tr>
                                                <td align="center" class="medium2">รูปปัจจุบัน</td>
                                            </tr>
                                        </table>
                                        <?php }else{ echo "<span class=\"headSm\">ไม่ได้อัพโหลดรูปประกอบขนาดเล็ก</span>";}?>
                                        <span class="description">ขนาดความกว้างไม่เกิน 600 พิกเซล ขนาดไฟล์ไม่เกิน 1 MB. (อนุญาติเฉพาะไฟล์ .gif .jpg .jpeg .png เท่านั้น)</span></td>
                                </tr>
                                <tr class="form-field">
                                    <th align="left" valign="top" scope="row">จำนวนรหัสใบเสร็จ</th>
                                    <td align="left" valign="top" class="idata"><input name="store_bill" type="text"  id="store_bill" size="60" value="<?php echo $row['store_bill']; ?>" /></td>
                                </tr>

                                <tr class="form-field">
                                    <th align="left" valign="top" scope="row">รายละเอียดใบเสร็จ</th>
                                    <td align="left" valign="top" class="idata">
                                        <textarea style="width: 97%;" cols="50" rows="5" id="store_bill_description" name="store_bill_description"><?php echo $row['store_bill_description']; ?></textarea>
                                    </td>
                                </tr>

                            </tbody>
                        </table>


                <p class="submit">
                    <input type="hidden" name="oldThumb" value="<?php echo $row["store_primary_img"];?>" />

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
<script type="text/javascript" src="../../js/jquery.numeric.js"></script>
<script type="text/javascript" src="../../js/jquery.idTabs.min.js"></script>
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
    // idTabs
    $("#main-tabs").idTabs();
</script>
<script type="text/javascript">
    //****************
    function checkForm(){
        if( $("#title").attr("value") == "" ) {
            alert("กรุณาระบุชื่อสินค้า");
            return false;
        }else if( $("#category_id").attr("value") == "" ) {
            alert("กรุณาระบุชื่อหมวดหลักสินค้า");
            return false;
            /* }else if( $("#subcategory_id").attr("value") == "" ) {
				  alert("กรุณาระบุชื่อหมวดย่อยสินค้า");
				  return false;
			}else if( $("#collection_id").attr("value") == "" ) {
				  alert("กรุณาระบุชื่อแบรนด์สินค้า");
				  return false;
			}else if( $("#unit").attr("value") == "" ) {
				  alert("กรุณาระบุจำนวน");
				  return false; */
        }else{
            return true;
        }
    }
</script>
<script type="text/javascript">
    $(".numeric").numeric();
    $(".integer").numeric(false, function() { alert("Integers only"); this.value = ""; this.focus(); });
    $(".positive").numeric({ negative: false }, function() { alert("No negative values"); this.value = ""; this.focus(); });
    $(".positive-integer").numeric({ decimal: false, negative: false }, function() { alert("Positive integers only"); this.value = ""; this.focus(); });
    $("#remove").click(
        function(e)
        {
            e.preventDefault();
            $(".numeric,.integer,.positive").removeNumeric();
        }
    );
</script>

<script language="javascript" type="text/javascript">
    function Inint_AJAX() {
        try { return new ActiveXObject("Msxml2.XMLHTTP");  } catch(e) {} //IE
        try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch(e) {} //IE
        try { return new XMLHttpRequest();          } catch(e) {} //Native Javascript
        alert("XMLHttpRequest not supported");
        return null;
    };


</script>

