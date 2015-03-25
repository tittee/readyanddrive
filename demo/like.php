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

			});


	});


});
</script>
<style>
	h1{margin-top: 20px;}
	.fb-like-box{background: #fff;}
</style>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

</head>
<body>
<div id="wrap-loading">
	<div class="loading">
		<span>Loading</span>
	</div>
</div>
<div id="wrappermain"  style="min-height:720px;">
	<!-- bg -->

	<header>
		<h1 class="text-center">
			<a href="#"><img src="images/logo-nobg.png" alt="LOGO"></a>
		</h1>
	</header>
	<br>
	<div class="container text-center">
		<div class="fb-like-box" data-href="https://www.facebook.com/readyenergy?fref=ts" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
		<img src="images/textlike.png" alt="">
	</div>








</div>


</body>
</html>























