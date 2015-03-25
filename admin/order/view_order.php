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

	#Create Obj
	$DB = mosConnectADODB();
	$msObj = new MS($DB);

	$errCode = "0";

	$id = mosGetParam( $_FORM, 'id', '' );
	$action = mosGetParam( $_FORM, 'action', '' );

	$qry = "select * from $_Config_table[orders] where order_id='$id' ";
	$rs = $DB->Execute($qry);
	$row = $rs->FetchRow();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title_web;?></title>
<meta content="<?php echo $keywords_web;?>" name="keywords">
<meta content="<?php echo $description_web;?>" name="description">
<link href="../css/css_bof.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="../../js/popup/css.css" />
<style type="text/css">
.fancybox-prev span, .fancybox-next span {
    /* .... */
    visibility: hidden;
}
</style>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  marginwidth="0" style="padding:3px;">
	<tr valign="top">
    	<td height="37" align="center">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="widefat post fixed">
        <thead>
        <tr>
        <th width="50%" align="left">Ref. order : <?php echo $row["order_ref"];?></th>
        <th colspan="2" align="left">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <tr valign="top">
       	  	<td align="left">
            <div style="padding-bottom:3px;" class="headLogBook">ที่อยู่ในการจัดส่งของ</div>
            <strong>ชื่อ :</strong> <?php echo $row["billing_fname"]?> <?php echo $row["billing_lname"]?><br />
            <strong>ที่อยู่ :</strong> <?php echo $row["billing_addr1"];?> <br />
            <?php echo $row["billing_subdistric"] ?> <?php echo $row["billing_distric"];?><br />
            <?php echo $msObj->getName($row["billing_province"], $_Config_table["province"], "province_id", "province_name")?> <?php echo $row["billing_zip"];?><br />
            <strong>เบอร์โทรศัพท์ :</strong> <?php echo $row["billing_phone"];?><br />
            <strong> เบอร์โทรสาร :</strong> <?php echo $row["billing_fax"]?><br />
            <strong>เบอร์โทรศัพท์มือถือ :</strong> <?php echo $row["billing_mobile"];?><br />
            <strong>อีเมล์ :</strong> <?php echo $row["billing_email"]?></td>
       	  	<td colspan="2" align="left" valign="top" class="row-title">
            <div style="padding-bottom:3px;" class="headLogBook">ที่อยู่ในการวางบิล</div>
       	  	  <strong>ชื่อ :</strong> <?php echo $row["shipping_fname"]?> <?php echo $row["shipping_lname"]?><br />
       	  	  <strong>ที่อยู่ :</strong> <?php echo $row["shipping_addr1"];?> <br />
              <?php echo $row["shipping_subdistric"];?>  <?php echo $row["shipping_distric"];?><br />
       	  	  <?php echo $msObj->getName($row["shipping_province"], $_Config_table["province"], "province_id", "province_name")?> <?php echo $row["shipping_zip"];?><br />
       	  	  <strong>เบอร์โทรศัพท์ :</strong> <?php echo $row["shipping_phone"];?><br />
       	  	  <strong> เบอร์โทรสาร :</strong> <?php echo $row["shipping_fax"]?><br />
       	  	  <strong>เบอร์โทรศัพท์มือถือ :</strong> <?php echo $row["shipping_mobile"];?><br />
       	  	  <strong>อีเมล์ :</strong> <?php echo $row["shipping_email"]?></td>
       	  </tr>
       <tr valign="top">
          <td colspan="3" align="left">
           <strong>การชำระเงิน  :</strong> <?php echo ($row["order_payment"] == "BANK")? "<span class=\"headGreen\">ชำระเงินผ่านธนาคาร</span>" : "<span class=\"headSm\">CREDIT</span>"; ?><br />
            <strong>สถานะการชำระเงิน :</strong> <?php echo ($row["order_status"] == "1")? "<span class=\"headGreen\">ชำระเงินเรียบร้อย</span>" : "<span class=\"headSm\">ยังไม่ชำระเงิน</span>"; ?><br />
            <strong>สถานะการส่งของ :</strong> <?php echo ($row["order_send"] == "1")? "<span class=\"headGreen\">ส่งของแล้ว</span>" : "<span class=\"headSm\">ยังไม่ส่งของ</span>"; ?></td>
          </tr>



          <tr valign="top">
       	  	<td colspan="3" align="center">
         <table width="100%" border="0" cellpadding="0" cellspacing="5" class="mediumBk">
			<tr>
                <?php
				$qry_order = "select * from $_Config_table[suborder] where order_id='$id' ";
				$rs_order = $DB->Execute($qry_order);
				$numrows = $rs_order->RecordCount();
				$total = 0;
				while ($detail_order = $rs_order->FetchRow()){
				$total += $detail_order["subtotal"];
					if(( $i != 1) && (($i % 2) == 1)){
						$i = 1;
						echo '</tr><tr valign="top">';
					}
				?>
                  <td valign="top" align="left" style="border-bottom-style:none"><table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#C9C9C9" class="medium">
              <tr>
                <td colspan="2" valign="top" bgcolor="#FFFFFF" style="border-bottom-style:none">
                  <table width="100%" border="0" class="medium">
                    <?php
					$qry_product = "select product_id, pic_thumb, product_name,product_discount_type
									from $_Config_table[product] where product_id='$detail_order[product_id]'";
                    $rs_product = $DB->Execute($qry_product);
                    $detail_product = $rs_product->FetchRow();

						$bath = ($detail_product["product_discount_type"] =="1")? "%" : "฿";
                    ?>
                  <tr>
                    <td width="110" valign="top" style="border-bottom-style:none; height:120px;">
                    <?php if($detail_product["pic_thumb"] != ""){?>
                    <?php FU::resizeImg("../../uploads/products/$detail_product[pic_thumb]", "100", $class="border");?>
                    <?php }else{ echo "<span class=\"headSm\">ไม่ได้อัพโหลดรูป</span>";}?>
                    </td>
                    <td align="left" valign="top" style="border-bottom-style:none"><strong>ชื่อสินค้า :</strong>&nbsp;<?php echo $detail_product["product_name"];?></td>
                  </tr>

                </table></td>
              </tr>
              <tr >
                <td width="14%" align="right" valign="top" nowrap="nowrap" bgcolor="#FFFFFF" style="border-bottom-style:none"><strong>วิธีการขนส่ง :</strong></td>
                <td width="86%" valign="top" bgcolor="#FFFFFF" style="border-bottom-style:none">
                <?php if($detail_order["carriage_id"]=="1"){
					echo "ขนส่งทางไปรษณีย์ ปกติ";
				}else if($detail_order["carriage_id"]=="2"){
					echo "ขนส่งทางไปรษณีย์ EMS";
				}else if($detail_order["carriage_id"]=="3"){
					echo "ขนส่งทางรถตู้";
				}else if($detail_order["carriage_id"]=="4"){
					echo "บริษัทขนส่ง";
				}else if($detail_order["carriage_id"]=="5"){
					echo "ขนส่งทางเครื่องบิน";
				}else{
					echo "กรุงเทพมหานคร";
				}
				?>
                </td>
              </tr>
              <tr >
                <td width="14%" align="right" valign="top" nowrap="nowrap" bgcolor="#FFFFFF" style="border-bottom-style:none"><strong>การแสดงความเห็น :</strong></td>
                <td width="86%" valign="top" bgcolor="#FFFFFF" style="border-bottom-style:none"><?php echo $row["order_comment"];?></td>
              </tr>
              <tr >
                <td width="14%" align="right" valign="top" nowrap="nowrap" bgcolor="#FFFFFF" style="border-bottom-style:none"><strong>ราคา :</strong></td>
                <td width="86%" valign="top" bgcolor="#FFFFFF" style="border-bottom-style:none"><?php echo number_format($detail_order["price"], 2, '.', ',');?> / ชิ้น</td>
              </tr>
              <tr >
                <td width="14%" align="right" valign="top" nowrap="nowrap" bgcolor="#FFFFFF" style="border-bottom-style:none"><strong>ค่าขนส่ง :</strong></td>
                <td width="86%" valign="top" bgcolor="#FFFFFF" style="border-bottom-style:none"><?php echo number_format($detail_order["carriage"], 2, '.', ',');?> / ชิ้น</td>
              </tr>
              <tr >
                <td align="right" valign="top" nowrap="nowrap" bgcolor="#FFFFFF" style="border-bottom-style:none"><strong>จำนวน :</strong></td>
                <td valign="top" bgcolor="#FFFFFF" style="border-bottom-style:none"><?php echo $detail_order["count"];?> ชิ้น</td>
              </tr>
              <tr >
                <td align="right" valign="top" nowrap="nowrap" bgcolor="#FFFFFF" style="border-bottom-style:none"><strong>ส่วนลด :</strong></td>
                <td valign="top" bgcolor="#FFFFFF" style="border-bottom-style:none"><?php echo $detail_order["discount"];?> <?php echo $bath?> </td>
              </tr>
              <tr >
                <td align="right" valign="top" nowrap="nowrap" bgcolor="#FFFFFF" style="border-bottom-style:none"><strong>รวม :</strong></td>
                <td valign="top" bgcolor="#FFFFFF" style="border-bottom-style:none"><?php echo number_format($detail_order["subtotal"], 2, '.', ',');?> บาท</td>
              </tr>
            </table></td>
                  <?php
						$i++;
						}
					?>
                </tr>
              </table>
            </td>
       	  	</tr>
        </tbody>

        <tfoot>
        <tr>
        <th align="left">&nbsp;</th>
        <th colspan="2" align="right">รวมราคาทั้งหมด (Total Price) :&nbsp;&nbsp; <span class="headSm"><?php echo number_format($total, 2, '.', ',')?></span> &nbsp;&nbsp;บาท</th>
        </tr>
        </tfoot>
        </table></td>
            </tr>
          </table>
</body>
</html>
<script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<script type="text/javascript" src="../../js/<?php echo $_Config_jquery_version;?>"></script>
<script type="text/javascript" src="../../js/popup/jquery-impromptu.3.1.js"></script>
<script language="javascript">

	<?php if($errCode != "0"){?>
	jQuery("#Show-result").slideDown(500).delay(10000).slideUp(500);
	<?php } ?>

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
