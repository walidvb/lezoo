(function($){
  Drupal.skewer = {
    start: function (selector) { 
      $(selector).addClass('skewer').one('transitionend', function () {
        $(selector).parent().addClass('rolling')
      }).addClass('start'); 
    },
    replaceContent: function (_loaderSelector, $next) {
      var $target = $(_loaderSelector);
      var $container = $target.parent();
      $next.addClass('skewer')
      $target.one('animationiteration', function () {
        $target.remove()
        $container.removeClass('rolling')
        $('.left-col, .right-col').scrollTop(0)
        $next.prependTo($container).addClass('arriving')
        void $next.get(0).offsetWidth
        $next.one('animationend', function () {
          $next.removeClass('arriving');
          void $next.get(0).offsetWidth;
          $next.addClass('arrived')
          $next.one('animationend', function () {
            $next.removeClass('skewer arrived');
          })
          Drupal.attachBehaviors($next)
        })
      })
    },
    end: function(){}
  }
})(jQuery)