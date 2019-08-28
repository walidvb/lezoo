(function ($) {
  Drupal.behaviors.loadMore = {};
  Drupal.behaviors.loadMore.attach = function (context) {
    console.log('attaching loading')
    $('.center-col a').on('click', function(evt){
      evt.preventDefault();
      var url = evt.currentTarget.href
      console.log(url)

      var $container = $('.right-col .panel-pane').addClass('load-container');
      $.ajax({
        url: url,
        success: function(res){
          console.log(res)
          var right = $(res).find('.right-col .pane-content')
          handleDone(right)
        },
      })

      var $target = $('.pane-content', $container);
      $target.one('transitionend', function () {
        $container.addClass('rolling')
      });

      function handleDone($next) {
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
            Drupal.attachBehaviors($next)
          })
        })
      };
      $target.addClass('start');
    })
  }
})(jQuery)
