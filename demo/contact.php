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
<link href="css/owl.carousel.css" rel="stylesheet" type="text/css">

<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/jquery.imgpreload.min.js"></script>
<script src="js/greensock/TweenMax.min.js"></script>
<script src="js/script.js"></script>
<!-- addprefix -->
<script type="text/javascript" src="js/prefixfree.min.js"></script>
<script src="js/jquery.imgpreload.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
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

			var activem = $('#mainmenu li.active');
			$('#mainmenu li:not(.active)').hover( function() {
				$(activem).removeClass('active');
			},
			function() {
				$(activem).addClass('active');
			});

			$("#itemnews").owlCarousel({
				items: 3,
				loop:false,
				nav:true,
				animateOut: 'fadeOut'
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
		<form action="" class="form">
			<legend class="text-center">
				<h1 class="title">ลงทะเบียน</h1>
				<h2>
					<img src="images/textcontact.png" class="pull-right textcontact" alt="ติดต่อเรา ตื่นจัดเต็ม">
				</h2>
			</legend>

			<!-- form input -->
			<ul class="formregis">
				<li class="leftr">
					<label class="lab">ชื่อ</label>
					<input type="text">
				</li>
				<li class="rightr">
					<label class="lab">นามสกุล</label>
					<input type="text">
				</li>
				<br clear="all">
				<li class="leftr">
					<label class="lab">อีเมล์</label>
					<input type="text">
				</li>
				<li class="rightr">
					<label class="lab">เบอร์ติดต่อ</label>
					<input type="text">
				</li>
				<li class="leftr">
					<label class="lab">เรื่องที่ต้องการติดต่อ</label>
					<input type="text">
				</li>
				<li class="rightr">
					<label class="lab">ข้อความ</label>
					<input type="text">
				</li>
				<br clear="all">
			</ul>
			<br clear="all">
			<fieldset class="scode text-center">
				<label class="lab">ใส่รหัสความปลอดภัยตามภาพที่ปรากฎด้านล่าง</label>
				<input type="text">
			</fieldset>

			<fieldset class="submit text-center">
				<input type="submit" value="ส่งข้อความ">
			</fieldset>

			<!-- endform -->
		</form>
		<section class="whatnews">
			<h2 class="text-center">ข่าวสารล่าสุด</h2>
			<div id="itemnews" class="itemnews owl-carousel">
				<div>
					<a href="#"><img src="images/news1.png"></a>
					<a href="#" class="textnews">ดื่มแล้วขับกับ ready ลุ้นรับ 5 รถ 5 สี</a>
				</div>
				<div>
					<a href="#"><img src="images/news2.png"></a>
					<a href="#" class="textnews">ใหม่! Ready Mixx สดชื่นกว่าด้วยวิตามิน a c e
และ กัวราน่าสกัด</a>
				</div>
				<div>
					<a href="#"><img src="images/new3.png"></a>
					<a href="#" class="textnews">ได้เวลาตื่นมาฟิน กับผู้ชายสุดอิน “ตู่ ภพธร”
กับคลิปที่ละลายใจสาวๆ ทั้งประเทศ</a>
				</div>

				<div>
					<a href="#"><img src="images/news1.png"></a>
					<a href="#" class="textnews">ดื่มแล้วขับกับ ready ลุ้นรับ 5 รถ 5 สี</a>
				</div>
				<div>
					<a href="#"><img src="images/news2.png"></a>
					<a href="#" class="textnews">ใหม่! Ready Mixx สดชื่นกว่าด้วยวิตามิน a c e
และ กัวราน่าสกัด</a>
				</div>
				<div>
					<a href="#"><img src="images/new3.png"></a>
					<a href="#" class="textnews">ได้เวลาตื่นมาฟิน กับผู้ชายสุดอิน “ตู่ ภพธร”
กับคลิปที่ละลายใจสาวๆ ทั้งประเทศ</a>
				</div>
			</div>
		</section>
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























