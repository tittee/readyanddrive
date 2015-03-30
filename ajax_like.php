
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
<script type="text/javascript" src="js/countdown/jquery.countdown.min.js"></script>
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
<!--<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>-->

    <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&appId=255129337996871&version=v2.3";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
</head>
<body>

<div id=""  style="">
	<!-- bg -->


    <div class=" text-center" style="width: 400px; min-height: 200px; ">
        <div id="countdown"></div>
		<!--<div class="fb-like-box" data-href="https://www.facebook.com/readyenergy?fref=ts" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>-->
        <div class="fb-page" data-href="https://www.facebook.com/118926511456194" data-width="400" data-height="400" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"></div>
        <!--<div class="fb-page" data-href="https://www.facebook.com/pages/%E0%B9%84%E0%B8%AE%E0%B9%84%E0%B8%A5%E0%B8%97%E0%B9%8C%E0%B9%80%E0%B8%94%E0%B8%AD%E0%B8%B0%E0%B8%A7%E0%B8%AD%E0%B8%A2%E0%B8%AA%E0%B9%8C%E0%B9%84%E0%B8%97%E0%B8%A2%E0%B9%81%E0%B8%A5%E0%B8%99%E0%B8%94%E0%B9%8C/1553306518221089?fref=ts" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"></div>-->
	</div>

</div>

    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('.fb-page').on('click', function() {
                $.fancybox.close( true );
                alert('sssssss');
            });

        });
    </script>
    <script type="text/javascript">
        var fullDate = new Date();
        var twoDigitMonth = fullDate.getMonth()+"";if(twoDigitMonth.length==1)  twoDigitMonth="0" +twoDigitMonth;
        var twoDigitDate = fullDate.getDate()+"";if(twoDigitDate.length==1) twoDigitDate="0" +twoDigitDate;
        var currentDate = twoDigitDate + "/" + twoDigitMonth + "/" + fullDate.getFullYear();

        /*console.log(currentDate);
        $('#countdown').countdown('2020/10/10 00:00:59', function(event) {
            $(this).html(event.strftime('จะปิดหน้าต่างภายใน %S'));
        });*/
        //$('#countdown').countdown({startTime: "00:00:60"});

        var count=60;

        var counter=setInterval(timer, 1000); //1000 will  run it every 1 second

        function timer()
        {
            count=count-1;
            if (count <= 0)
            {
                clearInterval(counter);
                return;
            }

            document.getElementById("countdown").innerHTML= "จะปิดหน้าต่างภายใน " + count + " วินาที"; // watch for spelling
        }
    </script>

</body>
</html>























