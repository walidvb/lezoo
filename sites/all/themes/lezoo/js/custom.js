(function($) {
	Drupal.behaviors.lezoo = {};
	Drupal.behaviors.lezoo.attach = function(context) {
		//trigger chosen all the time
		//-------------- change menu item
		var active_trail = $('.primary > .dropdown', context).find('ul .active-trail a').text();
		if(active_trail)
		{
			$('.primary .dropdown-toggle').html(active_trail + '<span class="caret"></span>');
		}
		if($.fn.dropdownHover)
		{
			$('.no-touch .dropdown-toggle').dropdownHover();
		}

		//-------------- stick months above list
		$('.view-display-id-events_teaser_all_date .view-content', context).once('lezoo_theme', function(){
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
		//-------------- 'More' menu item
		var activeText = $('.primary .last .dropdown-menu .active-trail a').text();
		var normalText = $('.primary .last .dropdown-toggle').text();
		if(activeText != '')
		{
			$('.primary .last .dropdown-toggle').addClass('active').html(activeText + '<span class="caret"></span>');
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
					block.slideToggle();
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

		//--------------------carousel work
		try{
			 $('.swiper', context).once(function(){
				var swiper = $(this).swiper({
					slideClass             : 'item',
					mode                   : 'horizontal',
					autoplay				: 5000,
					autoplayDisableOnInteraction: false,
					pagination             : '.carousel-indicators',
					paginationElement      : 'li',
					paginationElementClass : 'vert-pager',
					paginationActiveClass  : 'active',
					paginationVisibleClass : 'visible',
					paginationClickable    : true,
					initialSlide	: 0,
					loop: true,
					longSwipesRatio: 0.3,
					mousewheelControl: true,
					mousewheelControlForceToAxis: true,
					keyboardControl: true,
					resizeReInit: true,
					grabCursor: true,
					cssWidthAndHeight: false,
					onSwiperCreated: function(){
						$('.swiper').removeClass('loading loading-full');
					//attach behaviors to arrows
						$('.carousel-control').once(function(){
							$(this).bind('click', function(e){
								e.preventDefault();
								var dir = $(this).attr('data-slide') === 'prev' ? false : true;
								if(dir)
								{
									swiper.swipeNext();
								}
								else{
									swiper.swipePrev();
								}
							})
						});
				}
			});
		});
	} 
	catch(e){
		console.log('swiper', e);
	}
		//--------------------carousel light or dark
		$('.view-carousel .item', context).once('lezoo', function(){
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
		var $artistList = $('.front  #node-238');
		var timer, forceLoading, url;
		$('.artist-list-item', $artistList).each(function(){
			$(this).hover(function(){
				clearTimeout(timer);
				//needed so that onload test passes
				timer = 1;
				url = $(this).attr('data-img');
				var img = new Image();
				img.src = url;
				$artistList.css({
					'backgroundImage': 'url("/sites/all/themes/lezoo/img/logo.png")',
					'backgroundSize': '15%',
				}).addClass('loading');
				img.onload = function(){
					if(timer)
					{
						$artistList.css({
							'backgroundImage': 'url("' + url + '")',
							'backgroundSize': 'cover',
						}).removeClass('loading').addClass('showing');
					}
				};
			}, function(){
				clearTimeout(timer);
				setTimeout(function(){
					$artistList.css({
						'backgroundImage': 'url("/sites/all/themes/lezoo/img/logo.png")',
						'backgroundSize': '70px',
					}).removeClass('loading showing');
					timer = null;
				}, 150);
			})
		});
		//--------------------Attach to ajax loading of views:

		$('.view-teaser-list').once(function(){
			$(this).each(function(){
				var $this = $(this);
				 $this.ajaxStart(function(e){
				 	console.log(e);
				 	var view = $(e.currentTarget);
					view.addClass('loading loading-full');
				});
				$this.ajaxSuccess(function(e){
				 	var view = $(e.currentTarget);
				});
			});
		})
		//--------------------Overall
		var timer;
		function resize() 
		{
			clearTimeout(timer);
			timer = setTimeout(function(){
				stickEm();
				closeBlocks();
			}, 300);
		}
		resize();
		stickEm();
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
	};
})(jQuery);