jQuery(document).ready(function ($) {

	$(".wtg_title").click(function () {
		$(this).siblings(".wtg_description").slideToggle();
		$(this).parent(".way_to_give").toggleClass('open')
	});

});
