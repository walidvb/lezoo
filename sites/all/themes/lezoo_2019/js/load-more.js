console.log('config loading');
(function ($) {
  var xhr, loadingUrl
  var triggerSelector = '.center-col a, .flippy a, .calendar-row a';
  $(document).on('click', triggerSelector, function (evt) {
    evt.preventDefault();
    var url = evt.currentTarget.href;
    loadFromUrl(url)
  })
  window.onpopstate = function (evt) {
    loadFromUrl(document.location, true)
  }
  function loadFromUrl(url, popping) {
    $('body').addClass('loading right-focus');
    $('body').removeClass('center-focus');
    if (loadingUrl && loadingUrl !== url) {
      xhr && xhr.abort()
    }
    else if (loadingUrl) {
      return
    }
    var loaderSelector = ['.right-col .pane-content', '.left-col .panel-pane:not(.pane-system-main-menu) .pane-content'];

    loadingUrl = url
    xhr = $.ajax({
      url: url,
      success: function (res) {
        loadingUrl = null;
        handleDone($(res), loaderSelector[0]);
        handleDone($(res), loaderSelector[1]);
        var title = /<title>(.*)<\/title>/.exec(res)
        title = title ? title[1] : 'le ZOO'
        document.title = title
        if (popping) {
          History.replaceState({}, title, url);
        }
        else {
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
})(jQuery)