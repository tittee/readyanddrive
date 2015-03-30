<<<<<<< HEAD
<?php
error_reporting(E_ALL);
ini_set('display_errors','on');
ob_start("ob_gzhandler"); //เรียกทุกหน้าแล้วตรงนี้เลยปิด
header("Content-Encoding: gzip");
header('Content-type: text/html; charset=utf-8');//Header to tell browser what kind of file it is.
header("Cache-Control: must-revalidate");//Caching
$offset = 60 * 60;
$expire = "expires: " . gmdate ("D, d M Y H:i:s", time() + $offset) . " GMT";
@header($expires);
define( '_VALID_ACCESS', 1 );
session_start();

require_once( "configuration.php" );
require_once( $_Config_absolute_path . "/includes/ms_com.php" );
require_once( $_Config_absolute_path . "/includes/ms.class.php" );
require_once( $_Config_absolute_path . "/includes/datetime.class.php" );
require_once( $_Config_absolute_path . "/includes/func.class.php" );

#Create Obj
$DB = mosConnectADODB();
$msObj = new MS($DB);

$FU = new FU(); //Function Class
$DT = new DT(); //Datetime Class

/* ########## SESSION ##########*/
if( !isset($_SESSION['SESS_ID'] )){
    $_SESSION['SESS_ID'] = session_id();
}
/* ########## SESSION ##########*/

$sel_color = $msObj->sesssionColor($_SESSION['SESS_ID']);


//echo $sel_color['play_ready_color'];
$action = trim(mosGetParam( $_FORM, 'action', ''));

if( isset($action) && !empty($action) ){
    #Detail
    $vote = trim(mosGetParam($_FORM,'vote'));

}

?>
=======
>>>>>>> Clone In Cipher
<!DOCTYPE html>
<html lang="en">
<head>
<title>Ready</title>

<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=1400, initial-scale=1.0">
<meta name="robots" content="noindex">
<!-- css -->

<link href="css/animate.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet" type="text/css">

<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/jquery.imgpreload.min.js"></script>
<script src="js/greensock/TweenMax.min.js"></script>
<script src="js/script.js"></script>
<!-- addprefix -->
<script type="text/javascript" src="js/prefixfree.min.js"></script>
<script src="js/jquery.imgpreload.min.js"></script>
<script type="text/javascript">
$(function(){

	// TweenMax.set("#logo",{y:-10,alpha:0})
	// TweenMax.set("#bglogo",{y:-404,alpha:0})
	// TweenMax.set("#gotobegining", {scale:0.5,alpha:0,rotation:60});
	// TweenMax.set(".contentpage", {scale:0.5,alpha:0});

	$('body').addClass('hidden');
	$("#wrap-loading").show();
	$("body img").imgpreload(function(){
		$("#wrap-loading").fadeOut(function(){
			$('body').removeClass('hidden');

		});

	});
});
</script>

</head>
<body>
<div id="wrap-loading">
	<div class="loading">
		<span>Loading</span>
	</div>
</div>
<div id="wrappermain" class="wrapbg1">
	<a href="static.php" class="stat">
		<img src="images/stat.png" alt="สถิติ">
	</a>
	<!-- bg -->


	<?php include"header.php" ?>

	<div class="container topmain">
		<form action="" class="form">
			<legend class="text-center">
				<h1 class="title">ลงทะเบียน</h1>
				<h2 class="title">ส่งใบเสร็จร่วมกิจกรรม</h2>
			</legend>

			<!-- form input -->
			<ul class="formregis">
				<li class="leftr">
					<label class="lab">อีเมล์</label>
					<input type="text">
				</li>
				<li class="rightr">
					<label class="lab">ร้านค้า</label>
					<select>
						<option value="">- กรุณาเลือกร้านค้า -</option>
					</select>
				</li>
				<br clear="all">
				<li class="leftr">
					<label class="lab">ชื่อ <span>ไม่ค้องระบุคำนำหน้า</span></label>
					<input type="text">
				</li>
				<li class="rightr">
					<label class="lab">หมายเลขใบเสร็จ <span>กรุณาใส่หมายเลขใบเสร็จให้ถูกต้องครบถ้วน</span></label>
					<input type="text">
				</li>
				<li class="leftr">
					<label class="lab">นามสกุล</label>
					<input type="text">
				</li>
				<li class="rightr">
					<label class="lab">ร้านค้าอื่นๆ โปรดระบุ</label>
					<input type="text">
				</li>
				<li class="leftr">
					<label class="lab">เพศ</label>
					<div class="rowgent"><input type="radio" name="gent" id="male"><label for="male">ชาย</label></div>
					<div class="rowgent"><input type="radio" name="gent" id="famale"><label for="famale">หญิง</label></div>
				</li>
				<li class="rightr">
					<label class="lab">จังหวัดตามที่อยู่ปัจจุบัน</label>
					<select>
						<option value="">- กรุณาเลือกจังหวัด  -</option>
					</select>
				</li>
				<br clear="all">
				<li class="leftr">
					<label class="lab">เบอร์ติดต่อ</label>
					<input type="text">
				</li>
				<li>
					<label class="lab">คลิกที่โลโก้เพื่อดูตำแหน่งเลขที่ใบเสร็จร้านค้าร่วมรายการ</label>
				</li>
			</ul>
			<br clear="all">
			<fieldset class="scode text-center">
				<label class="lab">ใส่รหัสความปลอดภัยตามภาพที่ปรากฎด้านล่าง</label>
				<input type="text">
			</fieldset>

			<fieldset class="submit text-center">
				<a href="vote.php" class="pull-left">ย้อนกลับไปแก้ไข</a>
				<input type="submit" class="pull-left" value="ยืนยันการลงทะเบียน">
			</fieldset>

			<!-- endform -->
		</form>
	</div>

	<footer>
		<div class="text2"></div>
	</footer>

	<div class="social">
		<a href="#"><img src="images/youtube.png" alt=""></a>
		<a href="#"><img src="images/facebook.png" alt=""></a>
	</div>



</div>



</body>
</html>























