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

	$errCode="0";

	$action = trim(mosGetParam( $_FORM, 'action', '' ));
	$action_up = trim(mosGetParam( $_FORM, 'action_up', '' ));
	$filter = trim(mosGetParam( $_FORM, 'filter', '' ));
	$keyword = trim(mosGetParam( $_FORM, 'keyword', '' ));
	$id = mosGetParam( $_FORM, 'id', '' );

	if ($action_up !==""){
		$action = $action_up;
	}

	#Take action
	if( isset($action)&& !empty($action)){
		switch($action){

			case "Delete" :
				$num = count($id);
				for( $i = 0; $i < $num; $i++){
					#Delete News & Image table
					$qrySelOrder = "select * from $_Config_table[orders] where order_id = '$id[$i]' ";
					//echo $qrySelNews;
					$rsOrder = $DB->Execute($qrySelOrder);
					if (!$rsOrder)
    					print $DB->ErrorMsg();

					if( $rsOrder->RecordCount() > 0 ){
						$order = $rsOrder->FetchRow();
						$qryDelOrder = "delete from $_Config_table[suborder] where order_id = '$id[$i]'  ";
						$DB->Execute($qryDelOrder);

						$qryDelOrder = "delete from $_Config_table[orders] where order_id = '$id[$i]'";
						$rsDelOrder = $DB->Execute($qryDelOrder);
					}
				}
				$errCode="COMPLETE";
				$errBox["text"]= "ทำการลบสำเร็จ";
				break;

			case "Waitting" :
				$num = count($id);
				$query = "update $_Config_table[orders] set order_status='0' where ";
				for( $i = 0; $i < $num; $i++){
					$query .= "order_id = '$id[$i]' ";
					if($i < $num-1){
						$query .= " or ";
					}
				}
				$rs = $DB->Execute($query);
				$errCode="COMPLETE";
				$errBox["text"]= "ทำการเปลี่ยนสถานะเป็นรอการชำระเงินสำเร็จ";
				break;

			case "Paid" :
				$num = count($id);
				$query = "update $_Config_table[orders] set order_status='1' where ";
				for( $i = 0; $i < $num; $i++){
					$query .= "(order_id = '$id[$i]' )";
					if($i < $num-1){
						$query .= " or ";
					}
				}
				$DB->Execute($query);
				$errCode="COMPLETE";
				$errBox["text"]= "ทำการเปลี่ยนสถานะเป็นชำระเงินเรียบร้อยแล้วสำเร็จ";
				break;

			case "No Send" :
				$num = count($id);
				$query = "update $_Config_table[orders] set order_send='0' where ";
				for( $i = 0; $i < $num; $i++){
					$query .= "order_id = '$id[$i]' ";
					if($i < $num-1){
						$query .= " or ";
					}
				}
				$DB->Execute($query);
				$errCode="COMPLETE";
				$errBox["text"]= "ทำการเปลี่ยนสถานะเป็นยังไม่ได้ส่งของสำเร็จ";
				break;

			case "Send" :
				$num = count($id);
				$query = "update $_Config_table[orders] set order_send='1' where ";
				for( $i = 0; $i < $num; $i++){
					$query .= "order_id = '$id[$i]' ";
					if($i < $num-1){
						$query .= " or ";
					}
				}
				$DB->Execute($query);
				$errCode="COMPLETE";
				$errBox["text"]= "ทำการเปลี่ยนสถานะเป็นส่งของสำเร็จ";
				break;

			case "DeleteItem" :
				if ($id !="" ){
					$qrySelOrder = "select * from $_Config_table[orders] where order_id = '$id' ";
					$rsOrder = $DB->Execute($qrySelOrder);
					if( $rsOrder->RecordCount() > 0 ){
						$order = $rsOrder->FetchRow();
						$qryDelOrder = "delete from $_Config_table[suborder] where order_id = '$id'  ";
						$DB->Execute($qryDelOrder);

						$qryDelOrder = "delete from $_Config_table[orders] where order_id = '$id'";
						$rsDelOrder = $DB->Execute($qryDelOrder);
					}
				}
				$errCode="COMPLETE";
				$errBox["text"]= "ทำการลบสำเร็จ";
				break;

			case "WaittingItem" :
				if ($id !="" ){
					$query = "update $_Config_table[orders] set order_status='0' where order_id = '$id'";
					$rs = $DB->Execute($query);
				}
				$errCode="COMPLETE";
				$errBox["text"]= "ทำการเปลี่ยนสถานะเป็นรอการชำระเงินสำเร็จ";
				break;

			case "PaidItem" :
				if ($id !="" ){
					$query = "update $_Config_table[orders] set order_status='1' where order_id = '$id'";
					$DB->Execute($query);
				}
				$errCode="COMPLETE";
				$errBox["text"]= "ทำการเปลี่ยนสถานะเป็นชำระเงินเรียบร้อยแล้วสำเร็จ";
				break;

			case "NoSendItem" :
				if ($id !="" ){
					$query = "update $_Config_table[orders] set order_send='0' where order_id = '$id' ";
					$DB->Execute($query);
				}
				$errCode="COMPLETE";
				$errBox["text"]= "ทำการเปลี่ยนสถานะเป็นยังไม่ได้ส่งของสำเร็จ";
				break;

			case "SendItem" :
				if($id !="" ){
					$query = "update $_Config_table[orders] set order_send='1' where order_id = '$id[$i]' ";
					$DB->Execute($query);
				}
				$errCode="COMPLETE";
				$errBox["text"]= "ทำการเปลี่ยนสถานะเป็นส่งของสำเร็จ";
				break;
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
        <div class="alignleft_header"><h2>รายการสั่งซื้อ</h2></div>
        <div class="alignright_header"><input type="text" name="keyword" id="keyword" /> <input type="submit" class="button-primary" id="doaction" name="doaction" value="Search">
   	  </div>
    </div>

    <div class="header">
	<div class="updated" id="Show-result"><p><span class="headSm">การดำเนินการ : </span><span class="date"><?php echo $errBox["text"];?></span></p></div>
    </div>

	<div class="tablenav">
	  <div class="alignleft_actions">
        <select name="action_up" style="width:130px;">
        <option value="" selected="selected">-เลือก | Select-</option>
        <optgroup label="Payment status">
        <option value="Waitting">- รอ | Waitting</option>
        <option value="Paid">- ชำระแล้ว | Paid</option>
        </optgroup>
        <optgroup label="Send status">
        <option value="Send">- ส่ง | Send</option>
        <option value="No Send">- ยังไม่ส่ง | No Send</option>
        </optgroup>
        <option value="Delete">ลบ | Delete</option>
        </select>
        <input type="submit" class="button-primary" id="doaction" name="doaction" value="ทำงาน | Apply">

        <select class="postform" id="filter" name="filter" style="width:130px;">
        <option value="0" <?php if($filter == "0" || $filter == ""){ echo "selected";}else { echo "";}?>>ดูทั้งหมด | View all</option>
        <option value="1" <?php if($filter == "1"){ echo "selected";}else { echo "";}?>>ยังไม่ชำระเงิน | Unpaid</option>
        <option value="2" <?php if($filter == "2"){ echo "selected";}else { echo "";}?>>ชำระเงินแล้ว | Paid</option>
        <option value="3" <?php if($filter == "3"){ echo "selected";}else { echo "";}?>>ยังไม่ส่งของ | Not delivery</option>
        <option value="4" <?php if($filter == "4"){ echo "selected";}else { echo "";}?>>ส่งของแล้ว | Sent</option>
        <option value="5" <?php if($filter == "5"){ echo "selected";}else { echo "";}?>>ชำระเงินแล้วและยังไม่ได้ส่งของ | Paid & Not delivery</option>
        <option value="6" <?php if($filter == "6"){ echo "selected";}else { echo "";}?>>ชำระเงินและส่งของแล้ว | Paid & Sent</option>
        </select>
        <input type="submit" class="button-primary" value="กรอง | Filter" id="post-query-submit">

	</div>
    <div class="clear"></div>
  </div>


    <table cellspacing="0" class="widefat post fixed">
        <thead>
        <tr>
        <th width="2%" align="center"><input type="checkbox" name="checkAllAuto" id="checkAllAuto_Top"/></th>
        <th align="left">เลขที่ใบสั่งซื้อ</th>
        <th width="12%" align="center">ราคา</th>
        <th width="12%" align="center">การชำระเงิน</th>
        <th width="13%" align="center">สถานะการส่งของ</th>
        <th width="13%" align="left">วันที่</th>
        </tr>
        </thead>

        <tfoot>
        <tr>
        <th align="center"><input type="checkbox" name="checkAllAuto" id="checkAllAuto_Bottom"/></th>
        <th align="left">เลขที่ใบสั่งซื้อ</th>
        <th align="center">ราคา</th>
        <th align="center">การชำระเงิน</th>
        <th align="center">สถานะการส่งของ</th>
        <th align="left">วันที่</th>
        </tr>
        </tfoot>

        <tbody>
        <?php
		$Start_where = "0";

		if($keyword == ""){
			$qrySel1 = "select * from $_Config_table[orders] as o ";

			if($filter == "1"){
				$qrySel1.= " where  o.order_status = '0' ";
			}if($filter == "2"){
				$qrySel1.= " where o.order_status = '1' ";
			}if($filter == "3"){
				$qrySel1.= " where o.order_send = '0' ";
			}if($filter == "4"){
				$qrySel1.= " where o.order_send = '1' ";
			}if($filter == "5"){
				$qrySel1.= " where o.order_send = '1' and o.order_send = '0' ";
			}if($filter == "6"){
				$qrySel1.= " where o.order_send = '1' and o.order_send = '1' ";
			}
		}else{

			$qrySel1 = "select * from $_Config_table[orders] as o where
			o.order_ref like '%$keyword%'
			or o.billing_fname like '%$keyword%' or o.billing_lname like '%$keyword%' or o.billing_email like '%$keyword%'
			or o.shipping_fname like '%$keyword%' or o.shipping_lname like '%$keyword%' or o.shipping_email like '%$keyword%' ";

		}

		$rsSel1 = $DB->Execute($qrySel1);
		$numrows = $rsSel1->RecordCount();
		$qrySel2 = $qrySel1 . " order by o.order_id desc" ;
		$rsSel2 = $DB->SelectLimit($qrySel2, $limit, $start);
		while($row = $rsSel2->FetchRow()){
		?>
        <tr valign="top" id="<?php echo $row["order_id"];?>">
       	  	<td align="center" style="height: 60px;"><input type="checkbox" name="id[]" value="<?php echo $row["order_id"];?>"></td>
       	  	<td align="left" valign="top" class="row-title" id="<?php echo $row["order_id"];?>">
          	<strong><a title="Edit this item" href="view_order.php?id=<?php echo $row["order_id"];?>" class="fancy"><?php echo $row["order_ref"];?></a></strong> &nbsp;(<?php echo $row["billing_fname"]?> <?php echo $row["billing_lname"]?>)

            <br /><?php #echo $msObj->getName($row["payment_id"], $_Config_table["payment"], "payment_id", "payment_name");?>
            <div class="row-actions" id="row-actions-<?php echo $row["order_id"];?>">
              <?php /*?><span class="edit"><a title="Edit this item" href="edit_order.php?id=<?php echo $row["order_id"];?>">Edit</a> | </span><?php */?>
              <span class="view"><a rel="permalink" title="View this item" href="view_order.php?id=<?php echo $row["order_id"];?>" class="fancy">View</a> | </span>
              <span class="delete"><a href="?action=DeleteItem&id=<?php echo $row["order_id"];?>&filter=<?php echo $filter;?>" title="Delete this item" class="submitdelete">Delete</a></span>
            </div></td>
       	  	<td align="center" valign="top"><span class="row-title">
       	  	  <?php
			$qryprice = "select subtotal from $_Config_table[suborder] where order_id = '$row[order_id]' ";
			$rsprice = $DB->Execute($qryprice);
			$total = 0;
			while ($rowprice = $rsprice->FetchRow()){
				$total += $rowprice["subtotal"];
			}
			if($total != ""){
				echo "<span class=\"date\" style=\"padding-left:10px;\">".number_format($total, 2, '.', ',')."</span>";
			}else{
				echo "<span class=\"date\" style=\"padding-left:10px;\">ไม่ระบุราคา</span>";
			}?>
       	  	</span></td>

          	<td align="center" valign="top">
            <?php if($row["order_status"]=="1"){?>
            <a href="?filter=2" class="headGreen"><img src="../images/correct.png" width="20" height="20" border="0" /><br />
            ชำระเงินเรียบร้อย</a>
            <?php }else{ ?>
            <a href="?filter=1" class="headSm"><img src="../images/incorrect.png" width="20" height="20" border="0" /><br />
            ยังไม่ชำระเงิน</a>
            <?php }?>
            </td>
          	<td align="center" valign="top">
			<?php if($row["order_send"]=="1"){?>
            <a href="?filter=4" class="headGreen"><img src="../images/correct.png" width="20" height="20" border="0" /><br />
            ส่งของแล้ว</a>
            <?php }else{ ?>
            <a href="?filter=3" class="headSm"><img src="../images/incorrect.png" width="20" height="20" border="0" /><br />
            ยังไม่ส่งของ</a>
            <?php }?></td>
       	  	<td align="left" valign="top"><?php echo (DT::isDate($row["CreateDate"]))? DT::DateTimeShortFormat($row["CreateDate"], 0, 0, "Th") : "-" ;?></td>
          </tr>
          <?php } ?>
        </tbody>

    </table>
    <div class="tablenav">
        <div class="alignleft_actions">
        <select name="action">
        <option value="" selected="selected">-เลือก | Select-</option>
        <optgroup label="Payment status">
        <option value="Waitting">- รอ | Waitting</option>
        <option value="Paid">- ชำระแล้ว | Paid</option>
        </optgroup>
        <optgroup label="Send status">
        <option value="Send">- ส่ง | Send</option>
        <option value="No Send">- ยังไม่ส่ง | No Send</option>
        </optgroup>
        <option value="Delete">ลบ | Delete</option>
        </select>
        <input type="submit" class="button-primary" id="doaction" name="doaction" value="ทำงาน | Apply">
        <br class="clear">
      </div>
        <div class="alignright_actions"><?php include "nav_page.php";?></div>
        <br class="clear">
    </div>
    </form>
</div>
</body>
</html>
<script type="text/javascript" src="../../js/<?php echo $_Config_jquery_version;?>"></script>
<script type='text/javascript' src="../../js/jquery.tablednd_0_5.js"></script>
<script type='text/javascript' src="../../js/jquery_ui/ui/jquery.ui.core.js"></script>
<script type='text/javascript' src="../../js/jquery_ui/ui/jquery.ui.widget.js"></script>
<script type='text/javascript' src="../../js/jquery_ui/ui/jquery.ui.accordion.js"></script>
<script type="text/javascript" src="../../js/fancybox/jquery.fancybox.js"></script>

<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery("a.fancy").fancybox({
			'transitionIn'		: 'true',
			'transitionOut'		: 'true',
			'padding'			: 1,
			'width'				: 1000,
			'height'			: 800,
			'scrolling'			: 'auto',
			'titleShow'  		: false,
			'hideOnOverlayClick' : false,
			'type'		         : 'iframe'
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
