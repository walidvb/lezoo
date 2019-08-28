window.$ = jQuery
(function ($) {
  Drupal.behaviors.loadMore = {};
  Drupal.behaviors.loadMore.attach = function (context) {
    console.log('attaching loading')
    $('.center-col a').on('click', function(evt){
      evt.preventDefault();
      var url = evt.currentTarget.href
      var loaderSelector = '.right-col .pane-content';
      $('body').addClass('loading');
      $.ajax({
        url: url,
        success: function(res){
          handleDone($(res), loaderSelector);
        },
      })

      $(loaderSelector).addClass('skewer').one('transitionend', function () {
        $(loaderSelector).parent().addClass('rolling')
      });

      function handleDone($res, _loaderSelector) {
        var $target = $(_loaderSelector);
        var $container = $target.parent();
        var $next = $res.find(_loaderSelector).addClass('skewer')
        console.log($target)
        $target.one('animationiteration', function () {
          $target.remove()
          $container.removeClass('rolling')
          $next.prependTo($container).addClass('arriving')
          void $next.get(0).offsetWidth
          $next.one('animationend', function () {
            console.log('laaast fbit')
            $next.removeClass('arriving');
            void $next.get(0).offsetWidth;
            $next.addClass('arrived')
            $next.one('animationend', function(){
              $next.removeClass('skewer arrived');
            })
            Drupal.attachBehaviors($next)
          })
        })
      };
      $(loaderSelector).addClass('start');
    })
  }
})(jQuery)