(function($) {
	Drupal.behaviors.lezoo = {};
	Drupal.behaviors.lezoo.attach = function(context) {

		//-------------- stick months above list
		$('.view-display-id-panel_pane_1 .view-content')
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
		//---------------Pin left cols
		var container = '.content';
		$(container).css('display', 'inline-block');
		$(".pinned").wrapInner('<div/>');
		$('.pinned > div').pin({
      		containerSelector: container,
		  })
		//---------------Installations
		var flexsliderSettings = {
			selector: 'figure',
			animation: 'slide',

			contrlNav: 'thumbnails',	

		};
		$('.slider').flexslider(flexsliderSettings);
	};
})(jQuery);