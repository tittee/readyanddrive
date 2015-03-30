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

<script src="js/jquery.lightbox_me.js"></script>
<script type="text/javascript">
$(function(){

	var govote=$("#govote").attr("href");

	$('#popuprule').click(function() {
      $('#popupR').lightbox_me({
        centered: true,
        onLoad: function() {
			$("#govote").removeAttr('href');
			$('#checkrule').change(function() {
		        if($(this).is(":checked")) {
		           $("#govote").attr("href",govote);
		        }
		       	else{
		       	   $("#govote").removeAttr('href');
		       	}
		    });

			}
		});
      	return false;
    });

	$('body').addClass('hidden');
	$("#wrap-loading").show();
	$("body img").imgpreload(function(){
		$("#wrap-loading").fadeOut(function(){
			$('body').removeClass('hidden');

				var activem = $('#mainmenu li.active');
					$('#mainmenu li:not(.active)').hover( function() {
						$(activem).removeClass('active');
					},
					function() {
						$(activem).addClass('active');
				});

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

				setTimeout(function(){
					$('.speedready').addClass('maxspeed');
				}, 700);

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
		 		}, 2500);
		 		setTimeout(function(){
		       		$('.popupspeed.active').fadeIn('1000');
		       		setInterval(function(){
					    $('.popupspeed.active').toggleClass("animated pulse");
					}, 1500);
		 		}, 3500);
			}
		);

	});
});
</script>

</head>
<body>
<?php include"popuprule.php" ?>
<div id="wrap-loading">
	<div class="loading">
		<span>Loading</span>
	</div>
</div>
<div id="wrappermain" class="wrapbg2 bgcover">
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
				<img src="images/popupspeedgreen.png" class="popupspeed active" style="top:-66px; left:118px;">
				<div class="speedbg">
					<div class="speedready od-green"></div>
					<span class="valuevote">50%</span>
					<span class="resultvote">500000</span>
				</div>
			</li>
			<li>
				<img src="images/popupspeedblue.png" class="popupspeed" style="top:-82px; left:112px;">
				<div class="speedbg speedblue">
					<div class="speedready od-blue"></div>
					<span class="valuevote">50%</span>
					<span class="resultvote">400000</span>
				</div>
			</li>
			<li>
				<img src="images/popupspeedred.png" class="popupspeed" style="top:-53px; left:-115px;">
				<div class="speedbg speedred">
					<div class="speedready od-red"></div>
					<span class="valuevote">50%</span>
					<span class="resultvote">800000</span>
				</div>
			</li>
			<li>
				<img src="images/popupspeedyellow.png" class="popupspeed" style="top:-53px; left:-115px;">
				<div class="speedbg speedyellow">
					<div class="speedready od-yellow"></div>
					<span class="valuevote">50%</span>
					<span class="resultvote">600000</span>
				</div>
			</li>
			<li class="nomargin">
				<img src="images/popupspeedpurple.png" class="popupspeed" style="top:-53px; left:-115px;">
				<div class="speedbg speedpurple">
					<div class="speedready od-purple"></div>
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























