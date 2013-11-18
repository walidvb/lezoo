(function($) {
	Drupal.behaviors.lezoo = {};
	Drupal.behaviors.lezoo.attach = function(context) {
		//-------------- change menu item
		var active_trail = $('.primary > .dropdown').find('ul .active-trail a').text();
		console.log(active_trail);
		if(active_trail)
		{
			$('.primary .dropdown-toggle').html(active_trail + '<span class="caret"></span>');
		}
		
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

		//-------UUUUUUGLY
		$('.panel-panel.right').addClass('col-md-6 col-sm-6 col-xs-12');
	};

})(jQuery);