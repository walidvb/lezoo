var first = true;
(function ($) {
	var pushState = false;
	var current = 0;
	Drupal.behaviors.load_more = {
		attach: function(context, settings){
			var $settings = settings.load_more;
			var $trigger = $('.flippy a');
			var $targetContainerSelector = '.node.view-mode-full';
		//---------------------ajax calls
		var loadFrom = function (nid, triggerIndex){
			
			if(current != nid)
			{
				var targetContainer = $($targetContainerSelector).addClass('loading loading-full');
				var ajaxSettings = 
				{
					url: settings.basePath + 'load_more/' + nid,
					success: function(response)
					{
						var content = $(response.node_content);
						$('.flippy').remove();
						targetContainer.replaceWith(content);
						var script = content.script;
						$('head').append(script);
						$('body').trigger('item-loaded', triggerIndex, response);
						
						var title = window.document.title = response.node_title + ' | ' + settings.load_more.site_name;
					//Attach included scripts
					Drupal.attachBehaviors(content);
					current = nid;
					//Fix easy-social
					try{
						twttr.widgets.load();
					}catch(e){}
					try
					{
						gapi.plusone.go();
					}catch(e){}
					try
					{
						FB.XFBML.parse()
					}
					catch(e){}
					try
					{
						_gaq.push(['_trackPageview', '/' + settings.basePath + response.node_path]);
					}catch(e){}

					if(pushState)
					{
						History.pushState({
							nid: nid,
							triggerIndex: triggerIndex,
						}, title, '/' + settings.basePath + response.node_path);
						pushState = false;
					}
					targetContainer.removeClass('loading loading-full');
				},
				error: function(xhr,status,error)
				{
					console.log(xhr);
					console.log(status);
					console.log(error);
					targetContainer.removeClass('loading loading-full');
				}
			}
			$('body, html').animate({
				scrollTop: 0,
			}, 600);
			$.ajax(ajaxSettings);
		}
	}


	$trigger.once('load_more', function(){
		var $this = $(this);
		$this.addClass('clickable')
		.bind('click', function(e){
			e.preventDefault();
			var nid = parseInt($('span', $(this)).text());
			pushState = true;
			loadFrom(nid);
		});
	});
	var next = function(){
		if(!$('#colorbox').is(":visible")){
			$('.flippy .next').addClass('active').find('a').click();
		}
	}
	var prev = function(){
		if(!$('#colorbox').is(":visible")){
			$('.flippy .prev').addClass('active').find('a').click();
		}
	};
	Mousetrap.bind('left', prev);
	Mousetrap.bind('right', next);
	$('.touch .header').swipe({
		swipeLeft: next,
		swipeRight: prev
	});
	$('body').once('load-more', function(){
		$(this).bind('load-from', function(e, data){
			loadFrom(data.nid, data.index);
		});

		History.Adapter.bind(window,'statechange',function(){
			//console.log('first is ' , first);
			if(!first)
			{
				//console.log('will change');
				var State = History.getState();
				pushState = false;
				loadFrom(State.data.nid, State.data.triggerIndex);
				//console.log("State", State);
			}
			first = false;

		});
		//console.log(settings.load_more.nid)
		History.replaceState({'nid': settings.load_more.nid}, document.title, window.location.href);
	});
}
}
}(jQuery))