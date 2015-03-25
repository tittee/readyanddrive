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
<div id="wrappermain" class="wrapbg2 bgcover">
	<a href="#" class="stat">
		<img src="images/stat.png" alt="สถิติ">
	</a>
	<!-- bg -->


	<?php include"header.php" ?>

	<div class="container topmain">
		<div class="text-center">
			<h1 class="title">สถิติ</h1>
			<br clear="all">
			<h2><img src="images/textstat.png" alt="สถิติชวนตื่นเต้น" class="pull-right textstat"></h2>
		</div>



		<ul class="speedvote statvote clearfix">
			<li>
				<div class="speedbg">
					<span class="valuevote">50%</span>
					<span class="resultvote">500000</span>
				</div>
			</li>
			<li>
				<div class="speedbg speedblue">
					<span class="valuevote">50%</span>
					<span class="resultvote">400000</span>
				</div>
			</li>
			<li>
				<div class="speedbg speedred">
					<span class="valuevote">50%</span>
					<span class="resultvote">800000</span>
				</div>
			</li>
			<li>
				<div class="speedbg speedyellow">
					<span class="valuevote">50%</span>
					<span class="resultvote">600000</span>
				</div>
			</li>
			<li class="nomargin">
				<div class="speedbg speedpurple">
					<span class="valuevote">50%</span>
					<span class="resultvote">700000</span>
				</div>
			</li>
		</ul>
	</div>

	<footer>
		<div class="text3"></div>
	</footer>

	<div class="social">
		<a href="#"><img src="images/youtube.png" alt=""></a>
		<a href="#"><img src="images/facebook.png" alt=""></a>
	</div>



</div>



</body>
</html>























