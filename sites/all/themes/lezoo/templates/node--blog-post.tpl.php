  <?php

if(isset($content['field_music_genre']))
{
  $genres = $content['field_music_genre'];
  $genres['#access'] = true;
  hide($content['field_music_genre']);
}
if(isset($content['field_tags']))
{
  $tags = $content['field_tags'];
  hide($content['field_tags']);
}

?>

<div id="node-<?php print $node->nid; ?>" class="<?php print $classes ?> clearfix"<?php print $attributes; ?>>

  <?php print $user_picture; ?>

  <?php print render($title_prefix); ?>
  <?php if(!empty($title) && !$is_page): ?>
  <h3<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h3>
<?php endif; ?>
<?php print render($content['field_addthis']); ?>
<?php print render($title_suffix); ?> 



<div class="content"<?php print $content_attributes; ?>>
  <div class="<?php print $left_col_classes ?>">
    <?php print render($content['field_big_image']); ?>

    <?php 
    if(!empty($content['field_links'])){ print render($content['field_links']); } 
    if(!empty($content['field_soundcloud'])) { print render($content['field_soundcloud']); }
    if(!empty($content['field_event_ref'])) { print render($content['field_event_ref']); }
    if(!empty($related) && ($is_page || $teaser)){print $related;}
    ?>
  </div>
  <div class="<?php print $right_col_classes ?>">
    <?php
        // We hide the comments and links now so that we can render them later.
    hide($content['comments']);
    hide($content['links']);
    print render($content);
    ?>
  </div>
  <?php if ($display_submitted): ?>

  <div class="blog-info">
    <?php if(!$is_page): ?>
    <?php if(!$teaser): ?>
    <a href="#" class="expand-post">t(ouvrir)</a>
  <?php else: ?>
  <?php print l(t('+Read more'), 'node/' . $nid); ?>
<?php endif; ?>
<?php endif; ?>
<div class="submitted">
  <?php print $submitted; ?>
</div>
<?php if(isset($tags) || isset($genres)): ?>
  <div class="tags">
    <?php print render($tags); ?>
    <?php print render($genres); ?>
  </div>
<?php endif; ?>
</div>
<?php endif; ?>
</div>



<?php print render($content['comments']); ?>

</div>
