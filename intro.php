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
<style type="text/css">
    body{overflow: hidden;}
</style>
<script type="text/javascript">
$(function(){

	// TweenMax.set("#logo",{y:-10,alpha:0})
	// TweenMax.set("#bglogo",{y:-404,alpha:0})
	// TweenMax.set("#gotobegining", {scale:0.5,alpha:0,rotation:60});
	// TweenMax.set(".contentpage", {scale:0.5,alpha:0});


	$("#footer").css("bottom","-65px");
	$('body').addClass('hidden');
	$("#wrap-loading").show();
		var imgEffect = ["/img/ajax-loader.gif",
		"/img/preload-img.png",
		"/images/logo.png",
		"/images/bg.jpg",
		"/images/carblue.png",]
	$("body img").imgpreload(function(){
		$("#wrap-loading").fadeOut(function(){
			$('body').removeClass('hidden');
				beginAnimate();
				var activem = $('#mainmenu li.active');
				$('#mainmenu li:not(.active)').hover( function() {
						$(activem).removeClass('active');
					},
					function() {
						$(activem).addClass('active');
					}
				);
				$.supersized({

							// Thumbnail navigation
					slides: [			// Slideshow Images
						{image : 'images/bgIT.jpg'}
					],
				});

				// $('#icon').hover( function() {
				// 		$(".texticon").stop( true, true ).fadeIn();
				// 	},
				// 	function() {
				// 		$(".texticon").stop( true, true ).fadeOut();
				// 	}
				// );

				$('#icon').click( function() {
					if ($(".texticon").is(":visible")) {
						$(".texticon").fadeOut();
					}
					else
					{
						$(".texticon").fadeIn();
					}
				});


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
<div id="wrappermain"  style="min-height:720px;">
	<!-- bg -->
	<div class="icon" id="icon">
		<div class="relative">
			<img src="images/hovericon.png" alt="" class="texticon">
		</div>
	</div>

<header>
		<h1 class="logo">
			<a href="#" id="logo"></a>
		</h1>


	</header>

	<div class="container">
		<div class="text1">
			<img src="images/textintro1.png" alt="" class="textin1 textin animated bounceInDown">
			<img src="images/textintro2.png" alt="" class="textin2 textin animated bounceInDown">
			<img src="images/textintro3.png" alt="" class="textin3 textin animated bounceInDown">
		</div>
	</div>






	<div class="social">
		<a href="https://www.youtube.com/user/ReadyEnergyLive" target="_blank"><img src="images/youtube.png" alt=""></a>
		<a href="https://www.facebook.com/readyenergy" target="_blank"><img src="images/facebook.png" alt=""></a>
	</div>


</div>


</body>
</html>























