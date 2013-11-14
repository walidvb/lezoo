(function($) {
	Drupal.behaviors.lezoo = {};
	Drupal.behaviors.lezoo.attach = function(context) {
		//--------------
		//-------------- stick months above list
		$('.view-display-id-panel_pane_1 .view-content')
		.css('position', 'relative')
		.stickyHeaders({
			headlineSelector: 'h3:not(.node-title)',
			stickyElement: 'h3',
		});

		var stickEm = function(){
			$('.sticky-helper').css({
				width: $('.view-id-teaser_list .view-content').width(),
			});
		};
		
		//---------------Pin left cols
		$(".pinned").wrapInner('<div class="pinned-content"/>');

		var pinit = function()
		{
			var container = '.content';
			$('.pinned > .pinned-content').pin({
				containerSelector: container,
			});
			$(container).css({
				display: 'inline-block',
				width: '100%'
				});
			$('.content').scroll(function(e){
				console.log(e);
				$(this).find('.pinnded-content').trigger('scroll', e);
			});
		}

		function resize() 
		{
			pinit();
			stickEm();
		}
		resize();
		$(window).resize(resize);

	};
})(jQuery);