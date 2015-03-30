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
    $DT = new DT();

	$errCode="0";

	$action = trim(mosGetParam( $_FORM, 'action', '' ));
	$action_up = trim(mosGetParam( $_FORM, 'action_up', '' ));
	$category_id	= trim(mosGetParam($_FORM,'category_id'));
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

						$qryDel = "delete from  $_Config_table[staff] where staff_id =  '$id[$i]' ";
						$DB->Execute($qryDel);

					}
				}

				$errCode="COMPLETE";
				$errBox["text"]= "ทำการลบสำเร็จ";
				break;

			case "TurnOn" :
				$num = count($id);
				$query = "update  $_Config_table[staff] set status='1' where ";
				for( $i = 0; $i < $num; $i++){
					$query .= "(staff_id = '$id[$i]')";
					if($i < $num-1){
						$query .= " or ";
					}
				}
				$DB->Execute($query);
				$errCode="COMPLETE";
				$errBox["text"]= "การแสดงผลสำเร็จ";
				break;

			case "TurnOff" :
				$num = count($id);
				$query = "update  $_Config_table[staff] set status='0' where ";
				for( $i = 0; $i < $num; $i++){
					$query .= "(staff_id = '$id[$i]')";
					if($i < $num-1){
						$query .= " or ";
					}
				}
				$DB->Execute($query);
				$errCode="COMPLETE";
				$errBox["text"]= "ซ่อนการแสดงผลสำเร็จ";
				break;

			case "DeleteItem" :

				if ($id !="" ){
					$qryDel = "delete from  $_Config_table[staff] where staff_id =  '$id' ";
					$DB->Execute($qryDel);
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
	<h2>ผู้ดูแลระบบ&nbsp;&nbsp;
    <input name="action2" type="button" class="button-primary" onclick="MM_goToURL('parent','add.php');return document.MM_returnValue" value="เพิ่มผู้ดูแลระบบ | Add New" /></h2>
    <div class="updated" id="Show-result"><p><span class="headSm">การดำเนินการ : </span><span class="date"><?php echo $errBox["text"];?></span></p></div>
    <form action="" method="post" id="FormContent" name="FormContent">
	<div class="tablenav">
	  <div class="alignleft_actions">
        <select name="action_up" style="width:130px;">
        <option value="" selected="selected">-เลือก | Select-</option>
        <option value="TurnOn">เปิดการใช้งาน | Turn on User</option>
        <option value="TurnOff">ปิดการใช้งาน | Turn off User</option>
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
        <th align="left">ผู้ดูแลระบบ</th>
        <th width="18%" align="left">ระดับ</th>
        <th width="13%" align="left">วันที่</th>
        </tr>
        </thead>

        <tfoot>
        <tr>
        <th align="center"><input type="checkbox" name="checkAllAuto" id="checkAllAuto_Bottom"/></th>
        <th align="left">ผู้ดูแลระบบ</th>
        <th align="left">ระดับ</th>
        <th align="left">วันที่</th>
        </tr>
        </tfoot>

        <tbody>
        <?php
		$qrySel1 = "select * from $_Config_table[staff] as s where s.group_id  != '88' ";
		$rsSel1 = $DB->Execute($qrySel1);
		$numrows = $rsSel1->RecordCount();
		$qrySel2 = $qrySel1 . " order by s.staff_id desc" ;
		$rsSel2 = $DB->SelectLimit($qrySel2, $limit, $start);
		while($row = $rsSel2->FetchRow()){
		?>
        <tr valign="top" id="<?php echo $row["staff_id"];?>">
       	  	<td align="center"><input type="checkbox" name="id[]" value="<?php echo $row["staff_id"];?>"></td>
       	  	<td align="left" valign="top" class="row-title" id="<?php echo $row["staff_id"];?>"><strong><a href="edit.php?id=<?php echo $row["staff_id"];?>"><?php echo $row["username"];?></a></strong>
          	<div class="row-actions" id="row-actions-<?php echo $row["staff_id"];?>">
          	<span class="edit"><a title="Edit this item" href="edit.php?id=<?php echo $row["staff_id"];?>">Edit</a> | </span>
          	<span class="view"><a rel="permalink" title="View this item" href="view.php?id=<?php echo $row["staff_id"];?>">View</a> | </span>
          	<span class="delete"><a href="?action=DeleteItem&id=<?php echo $row["staff_id"];?>" title="Delete this item" class="submitdelete">Delete</a></span>
          	</div>
		  	</td>

       	  <td align="left" valign="top">
          	<?php
		  	switch($row["group_id"]){
				case "1" :
					echo "Administrator";
					break;
				case "2" :
					echo "Staff";
					break;
				}
			?></td>

            <td align="left" valign="top"><?php echo ($DT->isDate($row["CreateDate"]))? $DT->DateTimeShortFormat($row["CreateDate"], 0, 0, "Th") : "-" ;?><br />
          <?php echo ($row["status"]=="1")? "<span class=\"headGreen\">เปิดการใช้งาน</span>" : "<span class=\"headSm\">ปิดการใช้งาน</span>"; ?>
          </td>
          </tr>
          <?php } ?>
        </tbody>

    </table>
    <div class="tablenav">
        <div class="alignleft_actions">
        <select name="action">
        <option value="" selected="selected">-เลือก | Select-</option>
        <option value="TurnOn">เปิดการใช้งาน | Turn on User</option>
        <option value="TurnOff">ปิดการใช้งาน | Turn off User</option>
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
