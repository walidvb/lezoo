(function ($) {
	window.$ = jQuery
	$(document).on('click', '.back', function(){
		$('body').toggleClass('.center-focus .right-focus');
	})
	Drupal.behaviors.lezoo = {};
	Drupal.behaviors.lezoo.attach = function (context) {
		console.log('Attaching lezoo')
		//Add protocols to the videos
		var iframes = $('iframe.media-youtube-player, iframe.media-vimeo-player', context);
		iframes.each(function () {
			var src = $(this).attr('src');
			if (!/^(http)/.test(src)) {
				console.log('custom.js says ', src, ' should better have a protocol, as it don\'t, we cheat. it sucks');
				setTimeout(function () {
					$(this).attr('src', 'http:' + src);
					setTimeout(function () {
						$(this).attr('src', 'http:' + src);
					}, 500);
				}, 500);
			}
		});

		var $targets = $('.region-top-bar .block .view', context)
		$targets.each(function() {
			Drupal.attachBehaviors($(this).find('.view-content').clone().appendTo($(this)));
			$(this).addClass('marquee-ready')
		})

		var $calendarPanel = $('.page-agenda .center-col .pane-content')
		$('.page-agenda .center-col .pane-title', context).on('click', function () {
			console.log("$thisPanel")
			var $thisPanel = $(this).next()
			console.log($thisPanel)
			if ($thisPanel.is(':hidden')) {
				$calendarPanel.slideUp();
				$thisPanel.slideDown();
			}
		});


		var loadingMore = false
		$('.page-agenda .center-col .pane-views-panes .pane-content', context).on('scroll', function (evt) { 
			var $this = $(this)
			var currentScroll = this.scrollTop;
			var scrollableHeight = $(this).find('.view-content').get(0).offsetHeight
			var height = this.offsetHeight

			var parentClass;
			if(scrollableHeight - currentScroll < height + 100){
				if (!loadingMore){
					parentClass = '.' + [...$this.find('.view-calendar').get(0).classList].find(function(c){
						return /view-display-id-panel/.test(c)
					})
					loadNext();

				}
			}
			function loadNext(){
				loadingMore = true
				$this.addClass('loading-more')
				var nextPager = $this.find('.pager-next a')
				if(!nextPager){
					return
				}
				var url = nextPager.get(0).href;
				$.ajax({
					url: url,
					success: function(res){
						var newPosts = $(res).find(parentClass + ' .view-content > *');
						var pager = $(res).find(parentClass + ' .item-list');
						var $newContent = $this.find('.view-content');
						newPosts.appendTo($newContent);
						Drupal.attachBehaviors(newPosts);
						$this.find('.item-list').replaceWith(pager);
						loadingMore = false;
						$this.removeClass('loading-more');
					}
				})
			}
		});
	}
})(jQuery);
