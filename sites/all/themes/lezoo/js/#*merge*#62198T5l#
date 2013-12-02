(function($) {
	Drupal.behaviors.lezoo = {};
	Drupal.behaviors.lezoo.attach = function(context) {

		//-------------- stick months above list
		$('.page-agenda .view-display-id-panel_pane_1 .view-content')
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
		var activeText = $('.primary .last .dropdown-menu .active-trail a').text();
		var normalText = $('.primary .last .dropdown-toggle').text();
		console.log(activeText);
		if(activeText != '')
		{
			$('.primary .last .dropdown-toggle').html(activeText + '<span class="caret"></span>');
		}
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

		//--------------UUUUUGLY hack
		$('.bootstrap-twocol-stacked .panel-panel.right').addClass('col-md-6 col-sm-6 col-xs-12');

		//--------------Another ugly hack to avoid rewriting the whole carousel tpl
		// $('.carousel-caption').once('lezoo', function(){
		// 	$(this).addClass('clickable').on('click', function(){
		// 		console.log($('h4', $(this));
		// 		$('h4 a', $(this)).trigger('click');
		// 	});
		// })
	};
})(jQuery);