<div class="<?php print $classes ?>" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?> >
    <?php if(!empty($content['left'])): ?>
     <div class="left-col grid-item">
         <?php print $content['left']; ?>
     </div>
   <?php endif; ?>

   <div class="mobile-col-wrapper">
    <?php if(!empty($content['center'])): ?>
        <div class="center-col grid-item">
            <?php print $content['center']; ?>
        </div>
    <?php endif; ?>

    <?php if(!empty($content['right'])): ?>
    <div class="right-col grid-item">
        <div class="back">back to list</div>
        <?php print $content['right']; ?>
    </div>
    <?php endif; ?>
    </div>
</div>
