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
<script src="js/jquery.lightbox_me.js"></script>
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

				var greenspeed=20.5;
				var bluespeed=40;
				var redspeed=80;
				var yellowspeed=60;
				var purplespeed=70;

				var calgreen=greenspeed*360/190;
				var calblue=bluespeed*360/190;
				var calred=redspeed*360/190;
				var calyellow=yellowspeed*360/190;
				var calpurple=purplespeed*360/190;


				//$('.speedready').addClass('maxspeed');

				setTimeout(function(){
		       		$('.od-green').css({
						'-webkit-transform': 'rotate(' + calgreen + 'deg)',
						'transform': 'rotate(' + calgreen + 'deg)',
					});
		   			$('.od-blue').css({
						'-webkit-transform': 'rotate(' + calblue + 'deg)',
						'transform': 'rotate(' + calblue + 'deg)',
					});
		     		$('.od-red').css({
						'-webkit-transform': 'rotate(' + calred + 'deg)',
						'transform': 'rotate(' + calred + 'deg)',
					});
		     		$('.od-yellow').css({
						'-webkit-transform': 'rotate(' + calyellow + 'deg)',
						'transform': 'rotate(' + calyellow+ 'deg)',
					});
		      		$('.od-purple').css({
						'-webkit-transform': 'rotate(' + calpurple + 'deg)',
						'transform': 'rotate(' + calpurple+ 'deg)',
					});
		 		}, 1000);

				setTimeout(function(){
		       		$('.popupspeed.active').fadeIn('1000');
		       		setInterval(function(){
					    $('.popupspeed.active').toggleClass("animated pulse");
					}, 1500);
		 		}, 3500);


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
		<div class="text-center">
			<h1 class="title">ลงทะเบียน</h1>
			<br clear="all">
			<h2 class="textvote">ซื้อสีไหน เลือกสีนั้น</h2>
		</div>

		<form class="vote">

		<ul class="speedvote clearfix">
			<li>
				<img src="images/popupspeedgreen.png" class="popupspeed" style="top:-66px; left:118px;">
				<div class="speedbg">
					<div class="speedready od-green"></div>
					<span class="valuevote">20%</span>
					<span class="resultvote">500000</span>
				</div>
				<label for="votegreen"><img src="images/readygreen_vote.png" class="imgvote"></label>
				<fieldset class="bggreen">
					<input type="radio" name="vote" id="votegreen">
					<label for="votegreen">Ready Plus</label>
				</fieldset>

			</li>
			<li>
				<img src="images/popupspeedblue.png" class="popupspeed" style="top:-82px; left:112px;">
				<div class="speedbg speedblue">
					<div class="speedready od-blue"></div>
					<span class="valuevote">40%</span>
					<span class="resultvote">400000</span>
				</div>
				<label for="voteblue"><img src="images/readyblue_vote.png" class="imgvote"></label>
				<fieldset class="bgblue">
					<input type="radio" name="vote" id="voteblue">
					<label for="voteblue">Ready Plus</label>
				</fieldset>
			</li>
			<li>
				<img src="images/popupspeedred.png" class="popupspeed" style="top:-53px; left:-115px;">
				<div class="speedbg speedred">
					<div class="speedready od-red"></div>
					<span class="valuevote">80%</span>
					<span class="resultvote">800000</span>
				</div>
				<label for="votered"><img src="images/readyred_vote.png" class="imgvote"></label>
				<fieldset class="bgred">
					<input type="radio" name="vote" id="votered">
					<label for="votered">Ready Plus</label>
				</fieldset>
			</li>
			<li>
				<img src="images/popupspeedyellow.png" class="popupspeed" style="top:-53px; left:-115px;">
				<div class="speedbg speedyellow">
					<div class="speedready od-yellow"></div>
					<span class="valuevote">60%</span>
					<span class="resultvote">600000</span>
				</div>
				<label for="voteyellow"><img src="images/readyyellow_vote.png" class="imgvote"></label>
				<fieldset class="bgyellow">
					<input type="radio" name="vote" id="voteyellow">
					<label for="voteyellow">Ready Plus</label>
				</fieldset>
			</li>
			<li class="nomargin">
				<img src="images/popupspeedpurple.png" class="popupspeed" style="top:-53px; left:-115px;">
				<div class="speedbg speedpurple">
					<div class="speedready od-purple"></div>
					<span class="valuevote">70%</span>
					<span class="resultvote">700000</span>
				</div>
				<label for="votepurple"><img src="images/readypurple_vote.png" class="imgvote"></label>
				<fieldset class="bgpurple">
					<input type="radio" name="vote" id="votepurple">
					<label for="votepurple">Ready Plus</label>
				</fieldset>
			</li>
		</ul>
		<br>
		<fieldset class="submit text-center">
			<a href="register.php" style="margin-left:88px;">ยืนยันสีที่เลือก</a>
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























