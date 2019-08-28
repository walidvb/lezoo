console.log('config loading');
(function ($) {
  Drupal.behaviors.leZooloadMore = {};
  var xhr, loadingUrl
  Drupal.behaviors.leZooloadMore.attach = function (context) {
    window.onpopstate = function(evt){
      loadFromUrl(document.location, true)
    }
    $('.center-col a, .flippy a', context).on('click', function(evt){
      evt.preventDefault();
      var url = evt.currentTarget.href
      loadFromUrl(url)
    })
    function loadFromUrl(url, popping){
      console.log(loadingUrl, xhr)
      if (loadingUrl && loadingUrl !== url){
        xhr && xhr.abort()
      }
      else if (loadingUrl){
        return
      }
    var loaderSelector = ['.right-col .pane-content', '.left-col .panel-pane:not(.pane-system-main-menu) .pane-content'];
    $('body').addClass('loading');
      loadingUrl = url
      xhr = $.ajax({
        url: url,
        success: function (res) {
          loadingUrl = null;
          handleDone($(res), loaderSelector[0]);
          handleDone($(res), loaderSelector[1]);
          console.log(res, $(res).find('title'), $(res).find('title').text())
          var title = $(res).find('title').text()
          if (popping){
            History.replaceState({}, title, url);
          }
          else{
            History.pushState({}, title, url);
          }
        },
      })

      $(loaderSelector.join(',')).addClass('skewer').one('transitionend', function () {
        $(loaderSelector.join(',')).parent().addClass('rolling')
      });

      function handleDone($res, _loaderSelector) {
        var $target = $(_loaderSelector);
        var $container = $target.parent();
        var $next = $res.find(_loaderSelector).addClass('skewer')
        console.log($target)
        $target.one('animationiteration', function () {
          $target.remove()
          $container.removeClass('rolling')
          $('.left-col, .right-col').scrollTop(0)
          $next.prependTo($container).addClass('arriving')
          void $next.get(0).offsetWidth
          $next.one('animationend', function () {
            console.log('laaast fbit')
            $next.removeClass('arriving');
            void $next.get(0).offsetWidth;
            $next.addClass('arrived')
            $next.one('animationend', function () {
              $next.removeClass('skewer arrived');
            })
            Drupal.attachBehaviors($next)
          })
        })
      };
      $(loaderSelector.join(',')).addClass('start');
    }
  }
})(jQuery)