(function($) {
	Drupal.behaviors.lezoo = {};
	Drupal.behaviors.lezoo.attach = function(context) {
		//-------------- change menu item
		var active_trail = $('.primary > .dropdown').find('ul .active-trail a').text();
		if(active_trail)
		{
			$('.primary .dropdown-toggle').html(active_trail + '<span class="caret"></span>');
		}
		//-------------- stick menu
		var threshold = $('header');
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
		if(activeText != '')
		{
			$('.primary .last .dropdown-toggle').html(activeText + '<span class="caret"></span>');
		}

		
		//---------------Pin left cols
		var pinit = function() {}
		// if( $(".pinned").wrapInner('<div class="pinned-content"/>').length != 0)
		// {
		// 	var pinit = function()
		// 	{
		// 		var container = '.content';
		// 		$('.pinned > .pinned-content').pin({
		// 			containerSelector: container,
		// 		});
		// 		$(container).css({
		// 			display: 'inline-block',
		// 			width: '100%'
		// 		});
		// 	}
		// }

		//--------------------open/close blog posts
		if(typeof Drupal.settings.lezoo_theme !== 'undefined')
		{
			var nodeStatusClasses = Drupal.settings.lezoo_theme.node_status;

			$('.node-blog-post .expand-post').once('lezoo', function(){
				$(this).bind('click', function(e){
					e.preventDefault();
					$this = $(this);
					var newText = ($this.text() == 'ouvrir') ? 'fermer' : 'ouvrir';
					$this.text(newText);
					var post = $this.parents('.node-blog-post');
					var isOpen = post.hasClass(nodeStatusClasses.open);
					post.toggleClass(nodeStatusClasses.closed + ' ' + nodeStatusClasses.open);
				});
			});
		}


		//--------------------carousel light or dark
		$('.view-carousel .item').once('lezoo', function(){
			$(this).each(function(){
				var $this = $(this);
				var src = $(this).find('img').attr('src');
				if(src != 'undefined')
				{
					isItDark(src, function(isDark){
						$this.addClass(( isDark ? 'dark' : 'light' ));
					});
				}
			})
		});
		//--------------------Overall
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