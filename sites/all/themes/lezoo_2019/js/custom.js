(function ($) {
	window.$ = jQuery
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
		var marqueeSelector = '.region-top-bar .view-line-up-and-podcast-artists';
		console.log(marqueeSelector, $(marqueeSelector).length)
		$(marqueeSelector, context).each(function (i) {
			console.log(i)
			var direction = i % 2 ? 'left' : 'right';
			$(this).marquee({
				//duration in milliseconds of the marquee
				duration: 200000,
				//gap in pixels between the tickers
				gap: 50,
				//time in milliseconds before the marquee will start animating
				delayBeforeStart: 0,
				//'left' or 'right'
				direction: direction,
				//true or false - should the marquee be duplicated to show an effect of continues flow
				startVisible: true,
				pause
			});
		});

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
	}
})(jQuery);