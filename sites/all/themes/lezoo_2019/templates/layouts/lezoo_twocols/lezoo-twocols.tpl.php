<div class="<?php print $classes ?>" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?> >
  <?php if(!empty($content['top'])): ?>
    <div class="top row">
       <div class="col-xs-12">
        <?php print $content['top']; ?>
      </div>
    </div>
  <?php endif; ?>
 <?php if(!empty($content['top_left']) || !empty($content['top_right'])): ?>
  <div class="row">
    <?php if(!empty($content['top_left'])): ?>
      <div class="top-left col-sm-6 col-xs-12">
        <?php print $content['top_left']; ?>
      </div>
    <?php endif; ?>
    <?php if(!empty($content['top_right'])): ?>
      <div class="top-right col-sm-6 col-xs-12">
        <?php print $content['top_right']; ?>
      </div>
    <?php endif; ?>
  </div>
  <?php endif; ?>
   <?php if(!empty($content['center'])): ?>
    <div class="center row">
      <div class="col-xs-12">
        <?php print $content['center']; ?>
      </div>
    </div>
  <?php endif; ?>
  <?php if(!empty($content['bottom_left']) || !empty($content['bottom_right'])): ?>
    <div class="row">
      <?php if(!empty($content['bottom_left'])): ?>
        <div class="bottom-left col-sm-6 col-xs-12">
          <?php print $content['bottom_left']; ?>
        </div>
      <?php endif; ?>
      <?php if(!empty($content['bottom_right'])): ?>
        <div class="bottom-right col-sm-6 col-xs-12">
          <?php print $content['bottom_right']; ?>
        </div>
         <?php endif; ?>
    </div>
  <?php endif; ?>
  <?php if(!empty($content['bottom'])): ?>
    <div class="bottom row">
      <div class="col-xs-12">
        <?php print $content['bottom']; ?>
      </div>
    </div>
  <?php endif; ?>
</div>
