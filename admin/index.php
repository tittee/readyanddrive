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

require_once( "../configuration.php" );
require_once( $_Config_absolute_path . "/includes/ms_com.php" );
require_once( $_Config_absolute_path . "/includes/ms.class.php" );
require_once( $_Config_absolute_path . "/includes/datetime.class.php" );
require_once( $_Config_absolute_path . "/includes/func.class.php" );
require_once( "config_template.php" );

#Login ?
if( empty($_SESSION['_LOGIN']) || empty($_SESSION['_GRPID']) || empty($_SESSION['_ID'])){
    mosRedirect("_execlogout.php");
}

#Create Obj
$DB = mosConnectADODB();
$msObj = new MS($DB);

#####//Set Show Page ///////////////////////////////////////////////////////////////
$limit = '20';		// How many results should be shown at a time
$scroll = '6'; 	// How many elements to the record bar are shown at a time

$display = (!isset ($_GET['show']) || $_GET['show']==0)? 11 : $_GET['show'];
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
    <title>
        <?=$_Config_sitename?>'s Backoffice</title>
    <link href="<?php echo $_Config_live_site;?>/admin/css/css_bof.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo $_Config_live_site;?>/js/jquery_ui/themes/base/jquery.ui.all.css">
</head>

<body>
    <?php include "inc/headTag.tmpl.php";?>
    <div class="content-left">
        <div class="AccordionMenu">


            <h3><a href="#">สมาชิก | Member</a></h3>
            <div>
                <ul>
                    <li><a href="<?php echo $_Config_live_site."/admin/member/index.php "?>">จัดการสมาชิก</a>
                    </li>
                </ul>
            </div>

            <h3><a href="#">ร้านค้า | Store</a></h3>
            <div>
                <ul>
                    <li><a href="<?php echo $_Config_live_site."/admin/store/index.php "?>">จัดการร้านค้า</a>
                    </li>
                </ul>
            </div>

            <h3><a href="#">กิจกรรม | Campaign</a></h3>
            <div>
                <ul>
                    <li><a href="<?php echo $_Config_live_site."/admin/campaign/index.php "?>">กฏการเล่นของใบเสร็จ</a>
                    </li>
                    <li><a href="<?php echo $_Config_live_site."/admin/campaign/index.php "?>">จัดการกิจกรรม</a>
                    </li>
                </ul>
            </div>


        </div>
    </div>
    <div class="content-right">
        <div class="AccordionMenu">

            <h3><a href="#">รายงาน | Report</a></h3>
            <div>
                <ul>
                    <li><a href="<?php echo $_Config_live_site."/admin/report/index.php "?>">จัดการรายงาน</a>
                    </li>
                </ul>
            </div>

            <?php if($_SESSION[ '_GRPLEVEL']=="Administrator" ) { ?>
            <h3><a href="#">ผู้ดูแล | Admin</a></h3>
            <div>
                <ul>
                    <li><a href="<?php echo $_Config_live_site."/admin/staff/index.php "?>">จัดการผู้ดูแลระบบ</a>
                    </li>
                </ul>
            </div>
            <?php } ?>

        </div>
    </div>
    <p style="clear:both"></p>

    <script type='text/javascript' src='<?php echo $_Config_live_site;?>/js/<?php echo $_Config_jquery_version;?>'></script>
    <script type='text/javascript' src="<?php echo $_Config_live_site;?>/js/jquery_ui/ui/jquery.ui.core.js"></script>
    <script type='text/javascript' src="<?php echo $_Config_live_site;?>/js/jquery_ui/ui/jquery.ui.widget.js"></script>
    <script type='text/javascript' src="<?php echo $_Config_live_site;?>/js/jquery_ui/ui/jquery.ui.accordion.js"></script>
    <script type="text/javascript">
        jQuery(function() {
            var icons = {
                header: "ui-icon-circle-arrow-e",
                headerSelected: "ui-icon-circle-arrow-s"
            };
            jQuery(".AccordionMenu").accordion({
                icons: icons
            });
            jQuery(".AccordionMenu").accordion("option", "icons", icons);
        });

        jQuery('#checkAllAuto_Top, #checkAllAuto_Bottom').click(function() {
            var checkedValue = jQuery(this).attr('checked') ? 'checked' : '';
            jQuery(':checkbox').attr('checked', checkedValue);
        });

        jQuery('.row-title').live('mouseover', function() {
            var thisID = jQuery(this).attr('id');
            jQuery('.row-actions').hide();
            jQuery('#row-actions-' + thisID).show();
            jQuery('.row-title').live('mouseleave', function() {
                jQuery('#row-actions-' + thisID).hide();
            });
        });
    </script>

</body>

</html>
