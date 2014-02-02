<div class="<?php print $classes ?>" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?> >
  <div class="top row container col-xs-12">
    <?php print $content['top']; ?>
  </div>
  <div class="row container">
    <div class="top-left col-md-6 col-sm-6 col-xs-12">
      <?php print $content['top_left']; ?>
    </div>
    <div class="top-right col-md-6 col-sm-6 col-xs-12">
      <?php print $content['top_right']; ?>
    </div>
  </div>
  <div class="center row container col-xs-12">
    <?php print $content['center']; ?>
  </div>
  <div class="row container">
    <div class="bottom-left col-md-6 col-sm-6 col-xs-12">
      <?php print $content['bottom_left']; ?>
    </div>
    <div class="bottom-right col-md-6 col-sm-6 col-xs-12">
      <?php print $content['bottom_right']; ?>
    </div>
  </div>
  <div class="bottom row container col-xs-12">
    <?php print $content['bottom']; ?>
  </div>
</div>
