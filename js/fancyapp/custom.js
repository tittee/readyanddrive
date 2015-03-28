$(document).ready(function() {

	$('.fancybox').fancybox({
        padding     : 0,
        margin      : 0,
        width       : '100%',
        height      : '100%',
        type        : 'ajax',
        closeBtn    : false,
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
