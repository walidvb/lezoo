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

		var stickEm = function(){
			$('.sticky-helper').css({
				width: $('.view-id-teaser_list .view-content').width(),
			});
		};
		
		//---------------Pin left cols
		var pinit = function()
		{
			var container = '.content';
			$(container).css('display', 'inline-block');
			$(".pinned").wrapInner('<div/>');
			$('.pinned > div').pin({
				containerSelector: container,
			})
		}
		//---------------Installations
		var flexsliderSettings = {
			selector: 'figure',
			animation: 'slide',

			contrlNav: 'thumbnails',	

		};
		$('.slider').flexslider(flexsliderSettings);

		function resize() 
		{
			pinit();
			stickEm();
		}
		resize();
		$(window).resize(resize);

	};
})(jQuery);