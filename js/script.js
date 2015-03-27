function beginAnimate() {
	$(".wrapbg").delay(1500).addClass('zoom');
    $(".readygreen").delay(2500).addClass('zoomIn');

    var $post = $("#icon");
	setInterval(function(){
	    $post.toggleClass("shake");
	}, 5000);

	// TweenMax.set("#roomplan",{scale:0,alpha:0});
	// TweenMax.set("#masterplan",{scale:0,alpha:0});
	// TweenMax.set("#gallery",{scale:0,alpha:0});
	// TweenMax.set("#location",{scale:0,alpha:0});


	// // begin
	// TweenMax.to("#logo", 1, {y:0,alpha:1,delay:0.8,ease:Expo.easeOut});
	// TweenMax.to("#bglogo", 1, {y:0,alpha:1,ease:Expo.easeOut});
	// $("#footer").delay(200).animate({bottom:0});
	// // begin
	// $("#hfade1").delay(500).animate({bottom:"65px"},500);
	// $("#hfade2").delay(600).animate({bottom:"65px"},500);
	// $("#wrap-landing").css({zIndex:1000});
	// TweenMax.to("#landingpage", 1.5, {scale:1,alpha:1,ease:Expo.easeOut});

}







