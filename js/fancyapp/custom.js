$(document).ready(function() {

	$('.fancybox').fancybox({
        padding     : 0,
        margin      : 0,
        width       : '100%',
        height      : '100%',
        type        : 'ajax',
        closeBtn    : false,
        closeClick  : false,

        helpers : {
            overlay : {
                closeClick: false
            } // prevents closing when clicking OUTSIDE fancybox
        }
    });

	$("#fancybox-manual-b").click(function() {
		$.fancybox.open({
			href : '',
			type : 'iframe',
			padding : 5
		});
	});

    $(".hidden").fancybox().trigger('click');
});
