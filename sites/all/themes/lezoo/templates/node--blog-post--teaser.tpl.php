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

if(!$page)
{
  $title_tag = 'h3';
}
else
{
  $title_tag = 'h1';
}

?>

<div id="node-<?php print $node->nid; ?>" class="<?php print $classes ?> clearfix"<?php print $attributes; ?> style="background-image: url('<?php print get_img_url('node_teaser_mini_image','field_big_image', $node)?>')">

  <?php print $user_picture; ?>

  <?php print render($title_prefix); ?>
  <?php if(!empty($title) && !$is_page): ?>
  <a href="<?php print $node_url; ?>"><h3<?php print $title_attributes; ?>><?php print $title; ?></h3></a>
  <?php if ($display_submitted): ?>
    <div class="blog-info">
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
<?php endif; ?>
<?php print render($title_suffix); ?> 



<div class="content"<?php print $content_attributes; ?>>
    <?php
        // We hide the comments and links now so that we can render them later.
    hide($content['comments']);
    hide($content['links']);
    print render($content);
    ?>
  
</div>



<?php print render($content['comments']); ?>

</div>
