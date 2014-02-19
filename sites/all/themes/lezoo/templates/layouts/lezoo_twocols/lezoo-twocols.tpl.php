<div class="<?php print $classes ?>" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?> >
  <div class="top row">
     <div class="col-xs-12">
      <?php print $content['top']; ?>
    </div>
  </div>
  <div class="row">
    <div class="top-left col-sm-6 col-xs-12">
      <?php print $content['top_left']; ?>
    </div>
    <div class="top-right col-sm-6 col-xs-12">
      <?php print $content['top_right']; ?>
    </div>
  </div>
  <div class="center row">
    <div class="col-xs-12">
      <?php print $content['center']; ?>
    </div>
  </div>
  <div class="row">
    <div class="bottom-left col-sm-6 col-xs-12">
      <?php print $content['bottom_left']; ?>
    </div>
    <div class="bottom-right col-sm-6 col-xs-12">
      <?php print $content['bottom_right']; ?>
    </div>
  </div>
  <div class="bottom row">
    <div class="col-xs-12">
      <?php print $content['bottom']; ?>
    </div>
  </div>
</div>
