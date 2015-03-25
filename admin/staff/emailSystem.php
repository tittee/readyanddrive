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

	$errCode="0";

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
	<h2>อีเมล์ระบบ&nbsp;
      <input name="action2" type="button" class="button-primary" onclick="MM_goToURL('parent','edit_emailSystem.php');return document.MM_returnValue" value="แก้ไขอีเมล์ระบบ | Edit E-mail system" /></h2>
<div class="updated" id="Show-result"><p><span class="headSm">การดำเนินการ : </span><span class="date"><?php echo $errBox["text"];?></span></p></div>
    <form action="" method="post" id="FormContent" name="FormContent">
      <table cellspacing="0" class="widefat post fixed">
        <thead>
        <tr>
        <th colspan="2" align="center">&nbsp;</th>
        </tr>
        </thead>

        <tfoot>
        <tr>
        <th colspan="2" align="center">&nbsp;</th>
        </tr>
        </tfoot>

        <tbody>
        <?php
		$qrySel1 = "select site_email_from_name, site_email_from from $_Config_table[site] where site_id = '1' ";
		$rsSel1 = $DB->Execute($qrySel1);
		while($row = $rsSel1->FetchRow()){
		?>
        <tr valign="top">
          <td width="30%" align="center" valign="middle"><strong>ชื่ออีเมล์</strong></td>
          <td align="left" valign="middle"><?php echo (!empty($row["site_email_from_name"]))? $row["site_email_from_name"] : "<span class=\"headSm\">ยังไม่ได้รุุะบุ</span>";?></td>
        </tr>
        <tr valign="top">
       	  	<td align="center" valign="middle"><strong>อีเมล์</strong></td>
       	  	<td align="left" valign="middle"><?php echo (!empty($row["site_email_from"]))? $row["site_email_from"] : "<span class=\"headSm\">ยังไม่ได้รุุะบุ</span>";?></td>
        </tr>
        <?php } ?>
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
