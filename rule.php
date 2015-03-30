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
<div id="wrappermain" class="wrapbg1 bgcover">
	<a href="static.php" class="stat">
		<img src="images/stat.png" alt="สถิติ">
	</a>
	<!-- bg -->


	<?php include"header.php" ?>

	<div class="container topmain">
		<div class="text-center">
			<h1 class="title">กฏกติกา</h1>
			<br clear="all">
			<h2>
				<img src="images/textrule.png" alt="กติกาลุ้นตื่นตา" class="textrule">
			</h2>
		</div>

		<div class="rule1 text-center">
			<img src="images/rule1.png">
		</div>

		<figure class="youtubeframe text-center">
<<<<<<< HEAD
<<<<<<< HEAD
            <iframe width="854" height="480" src="https://www.youtube.com/embed/4HsPGD_BSFY?rel=0" frameborder="0" allowfullscreen></iframe>
=======
			<iframe width="854" height="480" src="https://www.youtube.com/embed/rES4V6TInXs?rel=0" frameborder="0" allowfullscreen></iframe>
>>>>>>> Clone In Cipher
=======
            <iframe width="854" height="480" src="https://www.youtube.com/embed/4HsPGD_BSFY?rel=0" frameborder="0" allowfullscreen></iframe>
>>>>>>> origin/master
		</figure>

		<div class="rulebox">
			<article>
				<section>
					<ol>
						<li>
							ผู้โชคดีที่ได้รับรางวัลต้องนำหลักฐานบัตรประจำตัวประชาชนตัวจริง  ที่มีชื่อตรงกับที่ลงทะเบียนในเว็บไซต์ หรือที่แปะหลังฉลาก <br>
พร้อมสำเนา 1 ชุด กรณีอายุต่ำกว่า 15 ปีบริบูรณ์ต้องนำสูติบัตรฉบับจริงมาแสดงและบิดา มารดา หรือผู้ปกครอง จะต้องนำ<br>
บัตรประจำตัวประชาชน และทะเบียนบ้านฉบับจริงมาแสดงเป็นหลักฐานในการขอรับรางวัลด้วยตนเองที่บริษัท เครื่องดื่มกระทิงแดง จำกัด  <br>
เลขที่ 288 ถนนเอกชัย แขวงบางบอน เขตบางบอน กรุงเทพมหานคร ในวันและเวลาทำการภายใน 60 วันนับแต่วันที่ทำการ<br>
ประกาศผลรางวัล ใน www.readyanddrive.com  หากเลยกำหนดถือว่าสละสิทธิ์
						</li>
						<li>
							ผู้ที่ได้รับการจับฉลากเลือกในแต่ละครั้งจะได้รับรางวัลตามที่กำหนด
						</li>
						<li>
							ผู้โชคดีต้องแสดงหลักฐานใบเสร็จที่มีข้อมูลตรงกับที่ลงะเบียนไว้ในเว็บไซต์ www.readanddrive.com 1 ใบเสร็จรับเงิน จะเท่ากับ 1 สิทธิ์ <br>
หรือ 1 ผู้ร่วมรายการ (หนึ่งใบเสร็จรับเงินมีสิทธิ์ลงทะเบียนได้ครั้งเดียว)
						</li>
						<li>ชื่อและนามสกุลที่กรอกลงไประหว่างการลงทะเบียนจะต้องเป็นชื่อจริง นามสกุลจริง ที่มีเอกสารทางกฏหมายมาพิสูจน์ตัวตนได้จริง</li>
						<li>ใบเสร็จที่สามารถเข้าร่วมกิจกรรมได้คือ ต้องระบุชื่อร้านค้า ชื่อสินค้า จำนวนสินค้า ราคาสินค้า เลขที่ใบเสร็จ วันที่ใบเสร็จ</li>
						<li>หมายเลขโทรศัพท์มือถือที่กรอกระหว่างลงทะเบียน  ต้องเป็นหมายเลขที่ใช้ติดต่อเพื่อรับของรางวัลได้ หากทางผู้จัดกิจกรรมและตัวแทน <br>
ผู้จัดกิจกรรมไม่สามารถติดต่อผู้โชคดีตามหมายเลขโทรศัพท์ได้ ถือว่าผู้นั้นสละสิทธิ์</li>
						<li>รางวัลที่ได้รับไม่สามารถเปลี่ยนเป็นเงินสดหรือของรางวัลอื่นได้ </li>
						<li>ผู้โชคดีที่ได้รับรางวัลมูลค่า 1,000 บาท ขึ้นไปจะต้องหักภาษี ณ ที่จ่าย 5 % ของมูลค่ารางวัลตามคำสั่งสรรพากรที่ ทป.101/2544</li>
						<li>บริษัทฯ ขอสงวนสิทธิ์ในการนำภาพ-เสียง ผู้โชคดีที่ได้รับรางวัลไปเผยแพร่ เพื่อการประชาสัมพันธ์ในโอกาสต่างๆ และ/หรือเพื่อประโยชน์ <br>
ทางการค้าของบริษัทฯ โดยไม่ต้องจ่ายค่าตอบแทนใด ๆ</li>
						<li>การตัดสินของคณะกรรมการถือเป็นเด็ดขาดและสิ้นสุด</li>
						<li>พนักงานบริษัท  เครื่องดื่มกระทิงแดง จำกัด บริษัทในเครือ คณะกรรมการดำเนินงานพร้อมครอบครัว และบริษัทตัวแทนโฆษณา <br>
ไม่มีสิทธิ์เข้าร่วมรายการนี้</li>
						<li>ชิ้นส่วนของใบเสร็จ และชิ้นส่วนของฉลาก หากมีการดัดแปลงแก้ไข หรือชำรุดหรือได้มาโดยมิชอบด้วยกฎหมายถือเป็นโมฆะ <br>
และไม่มีสิทธิ์รับรางวัล</li>
					</ol>
				</section>
			</article>
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























