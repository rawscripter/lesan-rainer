// scroll top script
$(window).scroll(function() {
	if ($(this).scrollTop() > 20) {
		$('#scroll_up').fadeIn();
	}else{
		$('#scroll_up').fadeOut();
	}
});

$('#scroll_up').on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	$('html , body').animate({scrollTop : 0}, 500);
});

