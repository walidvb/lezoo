// handleDone(null, '.left-col .visu-details', $($0).clone())
// $('.left-col .visu-details').addClass('skewer').parent().addClass('rolling')

(function ($) {
  $(document).ready(function () {
    var $container = $('<div class="visu-details-container"></div>')
    $('.left-col').append($container);
    var firstDetails = $($('.center-col .visu-details')[0]).clone()
    $container.html(firstDetails)
    var center = $('.center-col')
    var currentIndex = 0
    $('.page-visu .center-col').on('scroll', function (evt) {
      var centerTop = center.offset().top;
      var nodes = $('.center-col .node');

      for (let i = 0; i < nodes.length; i++) {
        const $this = $(nodes[i]);
        var thisTop = $this.offset().top
        var thisHeight = $this.height()
        if (thisTop - 50 <= centerTop && thisTop - centerTop + thisHeight > 0) {
          if (currentIndex === i) {
            return
          }
          currentIndex = i
          Drupal.skewer.start('.left-col .visu-details');
          var next = $this.find('.visu-details').clone();
          Drupal.skewer.replaceContent('.left-col .visu-details', next)
          break;
        }
      }
    })
  });
})(jQuery)