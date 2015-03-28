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

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Ready</title>

<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=1300">
<meta name="robots" content="noindex">
<!-- css -->


<link href="css/animate.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/supersized.css" type="text/css" media="screen" />

<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/jquery.imgpreload.min.js"></script>
<script src="js/greensock/TweenMax.min.js"></script>
<script src="js/script.js"></script>
<!-- addprefix -->
<script type="text/javascript" src="js/prefixfree.min.js"></script>
<script src="js/jquery.imgpreload.min.js"></script>

<script type="text/javascript" src="js/supersized.3.2.7.min.js"></script>

<!-- FancyApp -->
    <link rel="stylesheet" href="js/fancyapp/jquery.fancybox.css" type="text/css" />
<script type="text/javascript" src="js/fancyapp/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="js/fancyapp/custom.js"></script>

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
			// $.supersized({

			// 				// Thumbnail navigation
			// 		slides: [			// Slideshow Images
			// 			{image : 'images/bgIT.jpg'}
			// 		],
			// 	});

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
<div id="wrappermain" class="wrapbg1 bgcover">

	<a href="static.php" class="stat">
		<img src="images/stat.png" alt="สถิติ">
	</a>
	<!-- bg -->


	<?php include"header.php" ?>

	<div class="container topmain">
        <a href="ajax_like.php" class="fancybox"><span class="hidden"></span>&nbsp;</a>
		<div class="text-center">
			<h1 class="title">ลงทะเบียน</h1>
			<br clear="all">
			<h2 class="textvote">ซื้อสีไหน เลือกสีนั้น</h2>
		</div>

		<form class="vote">
        <!-- Ready Color -->
		<ul class="speedvote clearfix">
			<li>
				<div class="speedbg">
					<span class="valuevote">50%</span>
					<span class="resultvote">500000</span>
				</div>
				<label for="votegreen"><img src="images/readygreen_vote.png" class="imgvote"></label>
				<fieldset class="bggreen">
					<input type="radio" name="vote" id="votegreen">
					<label for="votegreen">Ready Plus</label>
				</fieldset>

			</li>
			<li>
				<div class="speedbg speedblue">
					<span class="valuevote">50%</span>
					<span class="resultvote">400000</span>
				</div>
				<label for="voteblue"><img src="images/readyblue_vote.png" class="imgvote"></label>
				<fieldset class="bgblue">
					<input type="radio" name="vote" id="voteblue">
					<label for="voteblue">Ready Plus</label>
				</fieldset>
			</li>
			<li>
				<div class="speedbg speedred">
					<span class="valuevote">50%</span>
					<span class="resultvote">800000</span>
				</div>
				<label for="votered"><img src="images/readyred_vote.png" class="imgvote"></label>
				<fieldset class="bgred">
					<input type="radio" name="vote" id="votered">
					<label for="votered">Ready Plus</label>
				</fieldset>
			</li>
			<li>
				<div class="speedbg speedyellow">
					<span class="valuevote">50%</span>
					<span class="resultvote">600000</span>
				</div>
				<label for="voteyellow"><img src="images/readyyellow_vote.png" class="imgvote"></label>
				<fieldset class="bgyellow">
					<input type="radio" name="vote" id="voteyellow">
					<label for="voteyellow">Ready Plus</label>
				</fieldset>
			</li>
			<li class="nomargin">
				<div class="speedbg speedpurple">
					<span class="valuevote">50%</span>
					<span class="resultvote">700000</span>
				</div>
				<label for="votepurple"><img src="images/readypurple_vote.png" class="imgvote"></label>
				<fieldset class="bgpurple">
					<input type="radio" name="vote" id="votepurple">
					<label for="votepurple">Ready Plus</label>
				</fieldset>
			</li>
		</ul>
        <!-- Ready Color -->
		<br>
		<fieldset class="submit text-center">
			<a href="register.php">ยืนยันสีที่เลือก</a>
		</fieldset>
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











