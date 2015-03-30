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

	if ($action_up !==""){
		$action = $action_up;
	}

	#Take action
	if( isset($action)&& !empty($action)){
		switch($action){
			case "Delete" :
				$num = count($id);
				if ($num >= "1" && $id !="" ){

					for( $i = 0; $i < $num; $i++){

						//Del pic in post
						$qrySel = "select * from $_Config_table[playgame] Where play_id = '$id[$i]' ";
						$rsSel = $DB->Execute($qrySel);

						if ($rsSel->RecordCount() > 0){
							$data = $rsSel->FetchRow();
							$qryDel = "delete from $_Config_table[playgame] where play_id = '$data[play_id]' ";
							$DB->Execute($qryDel);
						}
					}
				}

				$errCode="COMPLETE";
				$errBox["text"]= "ทำการลบสำเร็จ";
				break;


			case "DeleteItem" :

				if ($id !="" ){
					//Del pic in post
					$qrySel = "select * from $_Config_table[playgame] Where play_id = '$id' ";
					$rsSel = $DB->Execute($qrySel);

					if($rsSel->RecordCount() > 0){
						$data = $rsSel->FetchRow();
						$qryDel = "delete from $_Config_table[playgame] where play_id = '$data[play_id]' ";
					}
				}

				$errCode="COMPLETE";
				$errBox["text"]= "ทำการลบสำเร็จ";
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
        <div class="alignleft_header"><h2>การเล่นเกมส์</h2></div>
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
        <option value="Delete">ลบ | Delete</option>
        </select>
        <input type="submit" class="button-primary" id="doaction" name="doaction" value="ทำงาน | Apply">
	</div>
    <div class="clear"></div>
  </div>


    <table cellspacing="0" class="widefat post fixed">
        <thead>
        <tr>
            <th width="2%" align="center"><input type="checkbox" name="checkAllAuto" id="checkAllAuto_Top"/></th>
            <th align="left">ชื่อ-นามสกุล</th>
            <th width="10%" align="left">สีรสชาติ</th>
            <th width="17%" align="left">ร้านค้า</th>
            <th width="20%" align="left">ใบเสร็จ</th>
            <th width="13%" align="left">วันที่</th>
        </tr>
        </thead>

        <tfoot>
        <tr>
            <th align="center"><input type="checkbox" name="checkAllAuto" id="checkAllAuto_Bottom"/></th>
            <th align="left">ชื่อ-นามสกุล</th>
            <th align="left">สีรสชาติ</th>
            <th align="left">ร้านค้า</th>
            <th align="left">ใบเสร็จ</th>
            <th align="left">วันที่</th>
        </tr>
        </tfoot>

        <tbody>
        <?php
		$Start_where = "0";
		$qrySel1 = "select * from $_Config_table[playgame] as m";


        if( $keyword != '' ){
            $qrySel1 .= "
                left outer join $_Config_table[store] as st on m.store_id = st.store_id
                left outer join $_Config_table[member] as mem on m.member_id = mem.member_id
                where m.play_ready_color like '%$keyword%'
                or mem.member_fname like '%$keyword%'
                or mem.member_lname like '%$keyword%'
                or st.store_name like '%$keyword%'
                or m.store_other like '%$keyword%' ";
		}

		//echo $qrySel1;
		$rsSel1 = $DB->Execute($qrySel1);
		$numrows = $rsSel1->RecordCount();
		$qrySel2 = $qrySel1 . " order by m.play_id desc" ;
		$rsSel2 = $DB->SelectLimit($qrySel2, $limit, $start);
		while($row = $rsSel2->FetchRow()){
		?>
        <tr valign="top" id="<?php echo $row["play_id"];?>">
       	  	<td align="center" style="height: 60px;"><input type="checkbox" name="id[]" value="<?php echo $row["play_id"];?>"></td>

            <!--  1. สมาชิก -->
       	  	<td align="left" valign="top" class="row-title" id="<?php echo $row["play_id"];?>">
                <strong><a title="Edit this item" href="../member/view.php?id=<?php echo $row["play_id"];?>">
                    <?php echo $msObj->getFullname($row["member_id"], $_Config_table["member"], "member_id", "member_fname", "member_lname"); ?></a></strong>
                <div class="row-actions" id="row-actions-<?php echo $row["play_id"];?>">
                    <span class="delete"><a href="?action=DeleteItem&id=<?php echo $row["play_id"];?>&filter=<?php echo $filter;?>&keyword=<?php echo $keyword;?>" title="Delete this item" class="submitdelete">Delete</a></span>
                </div>
		  	</td>

            <!--  2. สีรสชาติน้ำ -->
            <td align="left" valign="top"><?php echo $msObj->getReadyColor($row["play_ready_color"]);?></td>

            <!--  3. ร้านค้า -->
            <td align="left" valign="top">
                <?php //เช็ตเงื่อนไขว่าเป็นร้านค้าไหน
                    if($row["store_id"] != '' || $row["store_id"] != 0): //เงือนไขที่ 2 ร้านค้าที่มีในระบบ
                        echo $msObj->getName($row["store_id"], $_Config_table["store"], "store_id", "store_name");
                    else: //เงือนไขที่ 2 ร้านค้าที่ไม่มีในระบบที่สามารถออกใบเสร็จได้
                        echo $row["store_other"];
                    endif;
                ?>
            </td>

            <!--  4. ใบเเสร็จ -->
            <td align="left" valign="top">
                <?php echo $row["play_bill"]; ?>
            </td>

            <!--  5. วันที่เล่นเกมส์ -->
            <td align="left" valign="top"><?php echo ($DT->isDate($row["play_date"]))? $DT->DateTimeShortFormat($row["play_date"], 0, 0, "Th") : "-" ;?></td>
          </tr>
          <?php } ?>
        </tbody>

    </table>
    <div class="tablenav">
        <div class="alignleft_actions">
        <select name="action">
        <option value="" selected="selected">-เลือก | Select-</option>
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
			'width'				: 800,
			'height'				: 800,
			'scrolling'			: 'auto',
			'titleShow'  		: false,
			'hideOnOverlayClick' : false,
			'type'					: 'iframe'
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
<script type="text/javascript">
  jQuery(document).ready(function() {
	//------**********-----//
	jQuery('#filter').change(function() {
		jQuery("#group_id")[0].selectedIndex = 0;
		jQuery("#verify_id")[0].selectedIndex = 0;
	});
	//------**********-----//
	jQuery('#group_id').change(function() {
		jQuery("#filter")[0].selectedIndex = 0;
		jQuery("#verify_id")[0].selectedIndex = 0;
	});
	//------**********-----//
	jQuery('#verify_id').change(function() {
		jQuery("#filter")[0].selectedIndex = 0;
		jQuery("#group_id")[0].selectedIndex = 0;
	});
	//------**********-----//
  });
</script>
