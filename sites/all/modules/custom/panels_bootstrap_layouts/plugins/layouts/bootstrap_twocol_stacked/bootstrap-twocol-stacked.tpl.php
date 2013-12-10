<div class="<?php print $classes ?>" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>
  <div class="row container">
    <?php print $content['top']; ?>
  </div>
    <div class="row container">

  <div class="col-sm-6 col-xs-12">
    <?php print $content['left']; ?>
  </div>
    <div class="col-sm-6 col-xs-12">
    <?php print $content['right']; ?>
  </div>
  </div>
  <div class="row container">
    <?php print $content['bottom']; ?>
  </div>
</div>
