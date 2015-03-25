<?php
$_Config_absolute_path = dirname(__FILE__);
//$_Config_live_site = 'http://www.acmebell.com';
//$_Config_root = 'http://www.acmebell.com';
//$_Config_redirect_home = 'http://www.acmebell.com/home.php';

$_Config_redirect_home = 'http://localhost:8080/readyanddrive/index.php';
$_Config_live_site = 'http://localhost:8080/readyanddrive';
$_Config_root = 'http://localhost:8080/readyanddrive';

$_Config_sitename = 'Ready And Drive'; //'จำหน่ายสินค้าเกาหลี รองเท้าผ้าใบส้นสูง รองเท้าแฟชั่น ชุดทำงาน รองเท้าผ้าใบผู้หญิง เสื้อทำงาน';
$_Config_description = '';
$_Config_ keyword = '';

$_Config_live_site_email = "readyanddrive.com";

$_Config_bookmarkurl = '';
$_Config_bookmarktitle = '';

$_Config_offline_message = 'This site is down for maintenance.<br /> Please check back again soon.';
$_Config_error_message = 'This site is temporarily unavailable.<br /> Please notify the System Administrator';
$_Config_debug = '0';
$_Config_lifetime = '900';
$_Config_MetaDesc = 'xxxxx';
$_Config_MetaKeys = 'xxxxx';
$_Config_MetaTitle = '1';
$_Config_MetaAuthor = '1';

$_Config_jquery_version = "jquery-1.8.2.min.js?v=1.1";

$_Display = "style='display: none;'"; //0 คือ ไม่มี 1 คือ มี
$_User_Avartar = 0; //0 คือ ไม่มี 1 คือ มี
$_FileURL = basename($_SERVER['REQUEST_URI']);

#Staff
$_Config_table["staff"] = 'staff';

#Award
$_Config_table["award"] = 'award';

#Member
$_Config_table["member"] = 'member';

#Playgame
$_Config_table["playgame"] = "playgame";

#Playrule
$_Config_table["playrule"] = "playrule";

#Report
$_Config_table["report"] = "report";

#Admin
$_Config_table["store"] = 'store';

#Province
$_Config_table["province"] = 'province';

$_EmailContact8WEB_name = "Support "; 	//Define @ [configuration.php]
$_EmailContact8WEB_from = "support@readyanddrive.org";	//Define @ [configuration.php]
?>
