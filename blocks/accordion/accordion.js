jQuery(document).ready(function ($) {

	$(".st_accordion-header").click(function () {
		$(this).siblings(".st_accordion-body").slideToggle();
		$(this).parent('.st_accordion-item ').toggleClass('open')
	});

});
