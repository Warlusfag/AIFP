$(document).ready(function($){
	var nav = $('#nav');

	$(window).scroll(function(){
               
		if ($(this).scrollTop() > 69){
			nav.addClass('fixed');
			//$('#content').css('padding-top', navHeight+'px');
		}
		else{
			nav.removeClass('fixed');
			//$('#content').css('padding-top', '0');
		}
	});
});