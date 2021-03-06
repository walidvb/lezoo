(function ($) {
  var xhr, loadingUrl
  var triggerSelector = [
    'body:not(.page-visu) .center-col a:not(.contextual-links-trigger)',
    '.flippy a', 
    // limited to page-agenda because the containers 
    '.page-agenda .calendar-row a', 
    'main .view-line-up-and-podcast-artists a'
  ].join(', ');
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
    if (popping) {
      history.replaceState({}, 'COUAC COUAC', url);
    }
    else {
      history.pushState({}, 'COUAC COUAC', url);
    }

    if (loadingUrl && loadingUrl !== url) {
      xhr && xhr.abort()
    }
    else if (loadingUrl === url) {
      return
    }
    var loaderSelector = ['.right-col .pane-content', '.left-col .panel-pane:not(.pane-system-main-menu) .pane-content'];

    loadingUrl = url
    xhr = $.ajax({
      url: url,
      success: function (res) {
        loadingUrl = null;
        Drupal.skewer.replaceContent(loaderSelector[0], $(res).find(loaderSelector[0]));
        Drupal.skewer.replaceContent(loaderSelector[1], $(res).find(loaderSelector[1]));
        addTitle();
        makeNodesActive(res);
        $('body').removeClass('loading')
        function addTitle(){
          var title = /<title>(.*)<\/title>/.exec(res)
          title = title ? title[1] : 'le ZOO'
          document.title = title;
        }
      },
    })
    Drupal.skewer.start(loaderSelector.join(','))
  }
  function makeNodesActive(context){
    var nid = $('.right-col [data-nid]', context).data('nid');
    $('.center-col  [data-nid]').removeClass('skewer out active');
    $('.center-col [data-nid="'+nid+'"]').addClass('skewer out active');
  }
  makeNodesActive(document.body)
})(jQuery)

// handleDone(null, '.left-col .visu-details', $($0).clone())
// $('.left-col .visu-details').addClass('skewer').parent().addClass('rolling')