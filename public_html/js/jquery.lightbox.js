/* Open the lightbox */
$(document).ready(function(){
	$('.lightbox.about').click(function(){
		$('.backdrop, .lightbox_content.about').animate({'opacity':'.60'}, 500, 'linear');
		$('.lightbox_content.about').animate({'opacity':'1.00'}, 500, 'linear');
		$('.backdrop, .lightbox_content.about').css('display', 'block');
		$('.lightbox_content.about').center();
		$('.lightbox_content.about').focus();
	});
	
	$('.lightbox.cart').click(function(){
		$('.backdrop, .lightbox_content.cart').animate({'opacity':'.60'}, 500, 'linear');
		$('.lightbox_content.cart').animate({'opacity':'1.00'}, 500, 'linear');
		$('.backdrop, .lightbox_content.cart').css('display', 'block');
		$('.lightbox_content.cart').center();
		$('.lightbox_content.cart').focus();
	});

	$('.lightbox_close').click(function(){
		close_box();
	});

	$('.backdrop').click(function(){
		close_box();
	});

});

/* Close the lightbox */
function close_box()
{
	$('.backdrop, .lightbox_content').animate({'opacity':'0'}, 300, 'linear', function(){
		$('.backdrop, .lightbox_content.about, .lightbox_content.cart').css('display', 'none');
		$('html, body').css({
    		'overflow': 'visible'
		});
	});
}

/* Center an element to the page using a fixed position */
jQuery.fn.center = function () {
    this.css("position","fixed");
    this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2)) + "px");
    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2)) + "px");
    return this;
}