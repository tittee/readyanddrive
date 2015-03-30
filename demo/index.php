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
			});

			$('#icon').click( function() {
				if ($(".texticon").is(":visible")) {
					$(".texticon").fadeOut();
				}
				else
				{
					$(".texticon").fadeIn();
				}
			});
			setTimeout(function(){
		       $(".lightcar").addClass("active");
		   	}, 5500);

			setTimeout(function(){
				$(".lightcar").removeClass("active");
				$('.hoveref img').addClass("transition")
		       	// popup
		       	$('#popupL').lightbox_me({
			        centered: true
			    });


		       	// hovercar
		       	$('.hoveref').hover(function(){
		       		$('.hoveref').not(this).addClass("nothover");
		       		$(this).find(".popuphome").addClass('active');
		       		$('.wrapcar').css('z-index','3')
			      },
			      function(){
			      	$('.hoveref').not(this).removeClass("nothover");
			      	$(this).find(".popuphome").removeClass('active');
			      	$('.wrapcar').css('z-index','2')
			      }
			   	);
		       //
		   	}, 6500);




		});

	});
});
</script>

</head>
<body>

<?php include"popuprule.php" ?>

<div id="popupL" style="display:none;">
 	<img src="images/popuphome.png" alt="">
	<a href="#" class="close" id="close_x">close</a>
</div>

<div id="wrap-loading">
	<div class="loading">
		<span>Loading</span>
	</div>
</div>
<div class="wrapbg"></div>
<div id="wrappermain">

	<!-- bg -->


	<?php include"header.php" ?>

	<div class="wrapcar addbg">
		<div class="relative">
			<div class="lightcar"></div>
			<div class="hoveref">
				<img src="images/popupgreen.png" class="popuphome popupgreen">
				<img src="images/readygreen.png" class="readygreen anima animated zoomIn">
				<img src="images/cargreen.png" class="cargreen anima animated fadeInRightBig">
			</div>
			<div class="hoveref">
				<img src="images/popupblue.png" class="popuphome popupblue">
				<img src="images/readyblue.png" class="readyblue anima animated zoomIn">
				<img src="images/carblue.png" class="carblue anima  animated fadeInRight">
			</div>
			<div class="hoveref">
				<img src="images/popupred.png" class="popuphome popupred">
				<img src="images/readyred.png" class="readyred anima animated zoomIn">
				<img src="images/carred.png" class="carred anima animated zoomIn">
			</div>
			<div class="hoveref">
				<img src="images/popupyellow.png" class="popuphome popupyellow">
				<img src="images/readyyellow.png" class="readyyellow anima animated zoomIn">
				<img src="images/caryellow.png" class="caryellow anima animated fadeInLeft">
			</div>
			<div class="hoveref">
				<img src="images/popuppurple.png" class="popuphome popuppurple">
				<img src="images/readypurple.png" class="readypurple anima animated zoomIn">
				<img src="images/carpurple.png" class="carpurple anima animated fadeInLeftBig">
			</div>
		</div>
	</div>

	<div class="text"></div>
	<a href="static.php" class="stat">
		<img src="images/stat.png" alt="สถิติ">
	</a>
	<div class="icon animated" id="icon">
		<div class="relative">
			<img src="images/hovericon.png" alt="" class="texticon">
		</div>
	</div>

	<div class="social">
		<a href="#"><img src="images/youtube.png" alt=""></a>
		<a href="#"><img src="images/facebook.png" alt=""></a>
	</div>

	<span class="alert">* รูปเพื่อใช้ในการโฆษณาเท่านั้น</span>

</div>


</body>
</html>























