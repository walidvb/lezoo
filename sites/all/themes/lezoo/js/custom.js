(function($) {
	Drupal.behaviors.lezoo = {};
	Drupal.behaviors.lezoo.attach = function(context) {
		//trigger chosen all the time
		//-------------- change menu item
		var active_trail = $('.primary > .dropdown').find('ul .active-trail a').text();
		if(active_trail)
		{
			$('.primary .dropdown-toggle').html(active_trail + '<span class="caret"></span>');
		}
		if($.fn.dropdownHover)
		{
			$('.no-touch .dropdown-toggle').dropdownHover();
		}

		$('.menu-1649 .form-control', context).once(function(){
			var li = $('this').parents('.leaf')
			$(this).focus(function(){
				li.addClass('active');
			});
			$(this).blur(function(){
				li.removeClass('active');
			});
		})
		//-------------- stick menu
		var threshold = $('header');
		//-------------- stick months above list
		$('.page-agenda .view-display-id-panel_pane_1 .view-content').once('lezoo_theme', function(){
			$(this).css('position', 'relative')
			.stickyHeaders({
				headlineSelector: 'h3:not(.node-title)',
				stickyElement: 'h3',
			});
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
		$(".no-touch .pinned").once(function(){
			//$(this).wrapInner('<div class="pinned-content"/>');
		});
		var pinit = function(){}
		/* {
			var container = '.content';
			$('.pinned > .pinned-content').once(function(){
				$(this).pin({
					containerSelector: container,
					fixedHeaderSelector: 'header',
					minWidth: 770,
				});
			});
			// $(container).css({
			// 	display: 'inline-block',
			// 	width: '100%'
			// });
		 }
		*/

		//--------------------Masonry the installs
		var installsPics = function(){

				//on not mobile, isotope
				$('.no-touch .node-installations #install-photos .swipe-wrap').isotope({
					itemSelector: '.field-photos',
				});

				//on mobile, slidejs the whole
				// $('.touch .node-installations .col-right').slidesjs({
				// 	width: $(window).width(),
				// 	pagination: {
				// 		active: false,
				// 	},
				// 	navigation: {
				// 		active: false,
				// 	}
				// });
		}

		//--------------------open/close 
		//---------region for mobile
		//Add Comments title as trigger for the box
		var $blockTitle = $('.group-trigger, .pane-title, .field-label', context);
		$blockTitle.parents('.panel-pane').addClass('closable');
		$blockTitle.once('lezoo', function(){
			$(this).addClass('clickable').bind('click', function()
			{
				if($(window).width() <= 767)
				{
					var title = $(this);

					var block = title.next();

					block.slideToggle( function()
					{
						if(title.toggleClass('closed').hasClass('closed'))
						{
							// $('html, body').animate(
							// {
							//	scrollTop: title.offset().top,
							// });
						}
					});
				}
			});
		});

		var closeBlocks = function(){

				$blockTitle.each(function(){
					if($(window).width() < 767)
					{
						$(this).next().hide();
					}
					else{
						$(this).next().show();	
					}
				});
			
		};
		//---------blog posts
		/* 
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
		*/

		//--------------------carousel work
		$('a.carousel-control').click(function(e){
			e.stopPropagation();
			e.preventDefault();
			var trg = $(this).attr('href');

			var dir = $(this).attr('data-slide');
			$(trg).carousel(dir);
		});
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
			});
		});

		//--------------------Artist list hover behavior
		var $artistList = $('#node-238');
		var timer;
		$('.artist-list', $artistList).each(function(){
			console.log($(this));
			$(this).hover(function(){
				clearTimeout(timer);
				$artistList.css('backgroundImage', 'url("' + $(this).attr('data-img') + '")');
			}, function(){
				timer = setTimeout($artistList.css('background-image', ''), 300);
			})
		});

		//--------------------Overall
		var timer;
		function resize() 
		{
			clearTimeout(timer);
			timer = setTimeout(function(){
			pinit();
			stickEm();
			installsPics();
			closeBlocks();
			}, 300);
		}
		resize();
		$(window).resize(resize);
		$(window).scroll(function(){
			if($(this).scrollTop() + $(this).outerHeight(true)  >= $(document).height())
			{
				$('footer').addClass('open');
			}
			else
			{
				$('footer').removeClass('open');
			}

		});

		//--------------UUUUUGLY hack
		//$('.bootstrap-twocol-stacked .panel-panel.right').addClass('col-md-6 col-sm-6 col-xs-12');


};

})(jQuery);