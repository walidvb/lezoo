(function($) {
	Drupal.behaviors.lezoo = {};
	Drupal.behaviors.lezoo.attach = function(context) {
		$('.view-id-teaser_list .view-content')
		.css('position', 'relative')
		.stickyHeaders({
			headlineSelector: 'h3',
			stickyElement: 'h3',
		});

		var sizeEmAll = function(){
			$('.sticky-helper').css({
				width: $('.view-id-teaser_list .view-content').width(),
			});
		};
		sizeEmAll();
		$(window).resize(sizeEmAll);

		//---------------Installations
		var flexsliderSettings = {
			selector: 'figure',
			animation: 'slide',

			contrlNav: 'thumbnails',	

		};
		$('.slider').flexslider(flexsliderSettings);
	};
})(jQuery);