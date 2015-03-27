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
	$errCode="0";

	$action = trim(mosGetParam( $_FORM, 'action', '' ));
	$action_up = trim(mosGetParam( $_FORM, 'action_up', '' ));
	$keyword = trim(mosGetParam( $_FORM, 'keyword', '' ));
	$id = mosGetParam( $_FORM, 'id', '' );

#Detail
$rule_play = trim(mosGetParam($_FORM,'rule_play'));
$rule_startdate = trim(mosGetParam($_FORM,'rule_startdate',''));
$rule_enddate = trim(mosGetParam($_FORM,'rule_enddate',''));

	if ($action_up !==""){
		$action = $action_up;
	}

	#Take action
	if( isset($action)&& !empty($action)){

        $qryUpdatePD2 = "UPDATE playrule SET
			  rule_play = $DB->qstr('$rule_play'),
			  rule_startdate =  $DB->qstr('$rule_enddate'),
			  rule_enddate = $DB->qstr('$rule_enddate'),
			  rule_createdate = now(),
			  rule_updatedate = now()
			WHERE rule_id= '1' ";

        $qryUpdatePD =  "UPDATE playrule SET
			  rule_play = $DB->qstr('$rule_play'),
			  rule_startdate =  $DB->qstr('$rule_enddate'),
			  rule_enddate = $DB->qstr('$rule_enddate'),
			  rule_createdate = now(),
			  rule_updatedate = now()
			WHERE rule_id = '1' ";

        echo $qryUpdatePD;
			/*$DB->Execute($qryUpdatePD);
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

	#####//Set Show Page ///////////////////////////////////////////////////////////////
	$limit = '20';		// How many results should be shown at a time
	$scroll = '6'; 	// How many elements to the record bar are shown at a time

	$display = (!isset ($_GET['show']) || $_GET['show']==0)? 1 : $_GET['show'];
	if( !empty( $userkey ) )
		$display = 1;

	$start = (($display * $limit) - $limit);
	################///////////////////////////////////////////////////////////////
	//=======================================================

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
<form action="" method="post" id="FormContent" name="FormContent">
    <div class="header">
        <div class="alignleft_header"><h2>กฏการเล่นของใบเสร็จ จัดการกิจกรรม</h2></div>
        <div class="alignright_header"><input type="text" name="keyword" id="keyword" /> <input type="submit" class="button-primary" id="doaction" name="doaction" value="Search">
   	  </div>
    </div>

    <div class="header">
	<div class="updated" id="Show-result"><p><span class="headSm">การดำเนินการ : </span><span class="date"><?php echo $errBox["text"];?></span></p></div>
	</div>



    <table cellspacing="0" class="widefat post fixed">
        <thead>
        <tr>
            <th width="16%" align="left">ชื่อ</th>
        <th align="left">รายการ</th>
        </tr>
        </thead>

        <tfoot>
        <tr>
            <th align="left" colspan="2">
                <input type="hidden" name="id" value="<?php echo $id;?>" />
                <input type="submit" value="บันทึก | Edit" name="action" class="button-primary">
                <input type="button" name="action2" value="ยกเลิก | Cancel" class="button-primary" onclick="MM_goToURL('parent','index.php');return document.MM_returnValue" />
            </th>
        </tr>
        </tfoot>

        <tbody>
        <?php
		$Start_where = "0";
        $qrySel1 = "select * from $_Config_table[playrule] as m";


        if( $keyword != '' ){
            $qrySel1 .= " where m.store_name like '%$keyword%' or m.store_bill_description like '%$keyword%'  ";
		}

		//echo $qrySel1;
		$rsSel1 = $DB->Execute($qrySel1);
		$numrows = $rsSel1->RecordCount();
$qrySel2 = $qrySel1 . " order by m.rule_order desc" ;
		$rsSel2 = $DB->SelectLimit($qrySel2, $limit, $start);
		$row = $rsSel2->FetchRow();
		?>
            <tr valign="top">
                <td align="left" valign="top" class="row-title">
                    จำนวนรอบการเล่นเกมส์ <br>
                    ค่าปกติ : 1
                </td>
                <td align="left" valign="top">
                    <input name="rule_play" type="text" id="rule_play" size="60" value="<?php echo ($row['rule_play'] != '')?$row['rule_play'] : '1'; ?>" />
                </td>
            </tr>
            <tr valign="top">
                <td align="left" valign="top" class="row-title">
                    วันที่เริ่ม - วันที่สิ้นสุด
                </td>
                <td align="left" valign="top">
                    <label for="rule_startdate">เริ่ม</label>
                    <input type="text" id="rule_startdate" name="rule_startdate" value="<?php echo $row['rule_startdate']; ?>">
                    <label for="rule_enddate">สิ้นสุด</label>
                    <input type="text" id="rule_enddate" name="rule_enddate" value="<?php echo $row['rule_enddate']; ?>">
                </td>
            </tr>
        </tbody>

    </table>

    </form>
</div>
</body>
</html>
<script type="text/javascript" src="../../js/<?php echo $_Config_jquery_version;?>"></script>
<script type='text/javascript' src="../../js/jquery.tablednd_0_5.js"></script>
<script type='text/javascript' src="../../js/jquery_ui/ui/jquery.ui.core.js"></script>
<script type='text/javascript' src="../../js/jquery_ui/ui/jquery.ui.widget.js"></script>
<script type='text/javascript' src="../../js/jquery_ui/ui/jquery.ui.accordion.js"></script>
<script type='text/javascript' src="../../js/jquery_ui/ui/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="../../js/fancybox/jquery.fancybox.js"></script>

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
<script>
    $(function() {
        $( "#rule_startdate" ).datepicker({
            defaultDate     : "+1w",
            dateFormat      : "yy-mm-dd",
            changeMonth     : true,
            numberOfMonths  : 1,
            onClose: function( selectedDate ) {
                $( "#rule_enddate" ).datepicker( "option", "minDate", selectedDate );
            }
        });
        $( "#rule_enddate" ).datepicker({
            defaultDate     : "+1w",
            dateFormat      : "yy-mm-dd",
            changeMonth     : true,
            numberOfMonths  : 1,
            onClose: function( selectedDate ) {
                $( "#rule_startdate" ).datepicker( "option", "maxDate", selectedDate );
            }
        });
    });
</script>
