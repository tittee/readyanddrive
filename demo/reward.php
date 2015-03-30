<!DOCTYPE html>
<html lang="en">
<head>
<title>Ready</title>

<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=1300">
<meta name="robots" content="noindex">
<!-- css -->

<!-- <link href="css/animations.css" rel="stylesheet"> -->
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
<script type="text/javascript" src="js/css3-animate-it.js"></script>
<script src="js/jquery.lightbox_me.js"></script>
<script type="text/javascript">
$(function(){

	// TweenMax.set("#logo",{y:-10,alpha:0})
	// TweenMax.set("#bglogo",{y:-404,alpha:0})
	// TweenMax.set("#gotobegining", {scale:0.5,alpha:0,rotation:60});
	// TweenMax.set(".contentpage", {scale:0.5,alpha:0});
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
			// $.supersized({
			var activem = $('#mainmenu li.active');
			$('#mainmenu li:not(.active)').hover( function() {
				$(activem).removeClass('active');
			},
			function() {
				$(activem).addClass('active');
			});


		});

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
<div id="wrappermain" class="wrapbg1">
	<a href="static.php" class="stat">
		<img src="images/stat.png" alt="สถิติ">
	</a>
	<!-- bg -->


	<?php include"header.php" ?>

	<div class="container topmain">
		<div class="text-center">
			<h1 class="title">ของรางวัล</h1>
			<br clear="all">
			<h2><img src="images/rewardtext.png" alt="ของรางวัลแจกเต็มตื่น" class="pull-right textreward animated bounceInDown"></h2>
		</div>

		<div class="wrapreward" >
			<div class="animatedParent">
				<img src="images/reward_jbl.png" alt="" class="reward reward1">
				<img src="images/reward_ipadmini.png" alt="" class="reward reward2">
			</div>
			<img src="images/reward_iphone6.png" alt="" class="reward reward3">
			<img src="images/reward_suzukil.png" alt="" class="reward reward4">
			<img src="images/textreward.png" alt="" class="reward text3m">
		</div>
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























