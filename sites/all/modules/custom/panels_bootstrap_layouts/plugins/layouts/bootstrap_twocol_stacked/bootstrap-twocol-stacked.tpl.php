<div class="row <?php print $classes ?>" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>
  <div class="col-xs-12">
    <?php print $content['top']; ?>
  </div>
  <div class="col-xs-12">
    <div class="row">
      <div class="col-sm-6 col-xs-12">
        <?php print $content['left']; ?>
      </div>
      <div class="col-sm-6 col-xs-12">
        <?php print $content['right']; ?>
      </div>
    </div>
  </div>
  <div class="col-xs-12">
    <?php print $content['bottom']; ?>
  </div>
</div>
