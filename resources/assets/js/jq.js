$(document).ready(function(){
	$(window).scroll(function(e) {
		if($(document).scrollTop()!=0)
			$('.sticky').addClass('is-sticky');
		else $('.sticky').removeClass('is-sticky');
	});
});