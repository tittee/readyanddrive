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
<script type="text/javascript" src="js/custom-form-elements.js"></script>
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
			$("#selectwinner").live('change', function() {
			    if ($(this).val() == 'winnerpic1')
			    {
			    	$('.result-w').removeClass("active");
			    	$('#result1').addClass("active");
			    }

			    if ($(this).val() == 'winnerpic2')
			    {
			    	$('.result-w').removeClass("active");
			    	$('#result2').addClass("active");
			    }

			    if ($(this).val() == 'winnerpic3')
			    {
			    	$('.result-w').removeClass("active");
			    	$('#result3').addClass("active");
			    }

			    if ($(this).val() == 'winnerpic4')
			    {
			    	$('.result-w').removeClass("active");
			    	$('#result4').addClass("active");
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
<div id="wrappermain" class="wrapbg1 bgcover">
	<a href="static.php" class="stat">
		<img src="images/stat.png" alt="สถิติ">
	</a>
	<!-- bg -->


	<?php include"header.php" ?>

	<div class="container topmain">
		<div class="text-center">
			<h1 class="title">ประกาศผล</h1>
			<br clear="all">
			<h2 class="title">
				รวมของรางวัลตลอดรายการจำนวน 20 รางวัล
			</h2>
			<h3 class="title">รวมมูลค่าทั้งสิ้น 3,028,850 บาท (สามล้านสองหมื่นแปดพันแปดร้อยห้าสิบบาท)</h3>
		</div>



		<article class="winnerbox clearfix">
			<div class="text-center"><h1>รายชื่อผู้ได้รับรางวัล</h1></div>
			<div class="selectwrap pull-right">
				<select class="styled" id="selectwinner">
					<option value="winnerpic1">- รายชื่อผู้โชคดีได้รับรางวัล JBL Clip -</option>
					<option value="winnerpic2">- รายชื่อผู้โชคดีได้รับรางวัล iPad mini 3 Ratina Wifi 16 Gb -</option>
					<option value="winnerpic3">- รายชื่อผู้โชคดีได้รับรางวัล iPhone6 (64gb) -</option>
					<option value="winnerpic4">- รายชื่อผู้โชคดีได้รับรางวัล รถยนต์ SUZUKI SWIFT รุ่น GLX -</option>
				</select>
			</div>

			<br clear="all">


			<section class="result-w active" id="result1">
				<img src="images/reward_jbl.png" class="winnerpic winnerpic1">
				<div class="showres">
					<h2>จับรางวัล</h2>
					<ul>
						<li>
							<span class="ep">ครั้งที่ 1</span>  4 พ.ค. 2558 <span class="name">คุณ xxxxxxx xxxxxxxxxxx กรุงเทพ </span>
						</li>
						<li>
							<span class="ep">ครั้งที่ 2</span>  11 พ.ค. 2558 <span class="name">คุณ xxxxxxx xxxxxxxxxxx กรุงเทพ </span>
						</li>
						<li>
							<span class="ep">ครั้งที่ 3</span>  18 พ.ค. 2558 <span class="name">คุณ xxxxxxx xxxxxxxxxxx กรุงเทพ </span>
						<li>
							<span class="ep">ครั้งที่ 4</span>  25 พ.ค. 2558 <span class="name">คุณ xxxxxxx xxxxxxxxxx กรุงเทพ</span>
						</li>
						<li>
							<span class="ep">ครั้งที่ 5</span>  1 มิ.ย. 2558 <span class="name">คุณ xxxxxxx xxxxxxxxxx กรุงเทพ</span>
						</li>
					</ul>
				</div>
			</section>

			<section class="result-w result-w2" id="result2">
				<img src="images/reward_ipadmini.png" class="winnerpic winnerpic1">
				<div class="showres">
					<h2>จับรางวัล</h2>
					<ul>
						<li>
							<span class="ep">ครั้งที่ 6</span>  8 มิ.ย. 2558 <span class="name">คุณ xxxxxxx xxxxxxxxxxx กรุงเทพ </span>
						</li>
						<li>
							<span class="ep">ครั้งที่ 7</span>  15 มิ.ย. 2558 <span class="name">คุณ xxxxxxx xxxxxxxxxxx กรุงเทพ </span>
						</li>
						<li>
							<span class="ep">ครั้งที่ 8</span>  22 มิ.ย. 2558 <span class="name">คุณ xxxxxxx xxxxxxxxxxx กรุงเทพ </span>
						<li>
							<span class="ep">ครั้งที่ 9</span>  29 พ.ค. 2558 <span class="name">คุณ xxxxxxx xxxxxxxxxx กรุงเทพ</span>
						</li>
						<li>
							<span class="ep">ครั้งที่ 10</span>  6 ก.ค. 2558 <span class="name">คุณ xxxxxxx xxxxxxxxxx กรุงเทพ</span>
						</li>
					</ul>
				</div>
			</section>

			<section class="result-w result-w3" id="result3">
				<img src="images/reward_iphone6.png" class="winnerpic winnerpic1">
				<div class="showres">
					<h2>จับรางวัล</h2>
					<ul>
						<li>
							<span class="ep">ครั้งที่ 11</span>  13 ก.ค. 2558 <span class="name">คุณ xxxxxxx xxxxxxxxxxx กรุงเทพ </span>
						</li>
						<li>
							<span class="ep">ครั้งที่ 12</span>  20 ก.ค. 2558 <span class="name">คุณ xxxxxxx xxxxxxxxxxx กรุงเทพ </span>
						</li>
						<li>
							<span class="ep">ครั้งที่ 13</span>  27 ก.ค. 2558<span class="name">คุณ xxxxxxx xxxxxxxxxxx กรุงเทพ </span>
						<li>
							<span class="ep">ครั้งที่ 14</span>  3 ส.ค. 2558 <span class="name">คุณ xxxxxxx xxxxxxxxxx กรุงเทพ</span>
						</li>
						<li>
							<span class="ep">ครั้งที่ 15</span>  10 ส.ค. 2558 <span class="name">คุณ xxxxxxx xxxxxxxxxx กรุงเทพ</span>
						</li>
					</ul>
				</div>
			</section>

			<section class="result-w" id="result4">
				<img src="images/reward_suzukil2.png" class="winnerpic winnerpic1">
				<br clear="all">
				<ul class="listresultcar">
					<li>
						<div class="resultcar result-c1">
							<img src="images/cargreen-s.png" style="left: -20px; top: -40px;">
							<span class="ep2">รถยนต์ Suzuki Swift รุ่น GLX สีเขียว</span> <span class="name">คุณ xxxxxxx xxxxxxxxxxx กรุงเทพ </span>
						</div>
					</li>

					<li>
						<div class="resultcar result-c2">
							<img src="images/carblue-s.png" style="left: -20px; top: -36px;">
							<span class="ep2">รถยนต์ Suzuki Swift รุ่น GLX สีฟ้า</span> <span class="name">คุณ xxxxxxx xxxxxxxxxxx กรุงเทพ </span>
						</div>
					</li>

					<li>
						<div class="resultcar result-c3">
							<img src="images/carred-s.png" style="left: 10px; top: -45px;">
							<span class="ep2">รถยนต์ Suzuki Swift รุ่น GLX สีแดง</span> <span class="name">คุณ xxxxxxx xxxxxxxxxxx กรุงเทพ </span>
						</div>
					</li>

					<li>
						<div class="resultcar result-c4">
							<img src="images/caryellow-s.png" style="left: -15px; top: -27px;">
							<span class="ep2">รถยนต์ Suzuki Swift รุ่น GLX สีเหลือง</span> <span class="name">คุณ xxxxxxx xxxxxxxxxxx กรุงเทพ </span>
						</div>
					</li>

					<li>
						<div class="resultcar result-c5">
							<img src="images/carpurple-s.png" style="left: -15px; top: -35px;">
							<span class="ep2">รถยนต์ Suzuki Swift รุ่น GLX สีม่วง</span> <span class="name">คุณ xxxxxxx xxxxxxxxxxx กรุงเทพ </span>
						</div>
					</li>
				</ul>
			</section>

		</article>


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























