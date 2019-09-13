  <?php

if(isset($content['field_music_genre']))
{
  $genre_field_name = 'field_music_genre';
  $genres['#access'] = true;
  $genres            = $content[$genre_field_name];
  hide($content['field_music_genre']);
}
if(isset($content['field_tags']))
{
  $tags = $content['field_tags'];
  hide($content['field_tags']);
}

hide($content['flippy_pager']);
?>
<div data-nid="<?php print $node->nid; ?>" id="node-<?php print $node->nid; ?>" class="<?php print $classes ?> clearfix"<?php print $attributes; ?>>
  <?php print $user_picture; ?>
  <div class="news-header">
    <?php print render($title_prefix); ?>
    <?php if(!empty($title) && !$is_page): ?>
      <h1 <?php print $title_attributes; ?>  ><?php print $title; ?></h1>
    <?php endif; ?>
    <?php if(isset($tags) || isset($genres)): ?>
      <div class="tags">
        <?php print render($tags); ?>
        <?php print render($genres); ?>
      </div>
    <?php endif; ?>
    <?php print render($title_suffix); ?>
  </div>
<?php print $share42; ?>
<div class="content row"<?php print $content_attributes; ?>>
  <?php if ($display_submitted): ?>
    <div class="blog-info col-xs-12">
    </div>
  <?php endif; ?>
  <div class="<?php print $left_col_classes ?>">
    <?php if(!empty($content['field_links']) || !empty($content['field_event_ref'])): ?>
      <div class="closable">
        <div class="blog-details">
          <?php
          if(!empty($content['field_links'])){ print render($content['field_links']); }
          if(!empty($content['field_event_ref'])) { print render($content['field_event_ref']); }
          ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
  <div class="<?php print $right_col_classes ?>">
    <div class="closable">
      <div class"blog-artist">
      <?php
          if(!empty($content['field_artist'])) { print render($content['field_artist']); }
      ?>
    </div>
      <div>
        <?php
          if(!empty($content['field_media'])) { print render($content['field_media']); }

              // We hide the comments and links now so that we can render them later.
          hide($content['comments']);
          hide($content['links']);
          print render($content);
        ?>
      </div>
    </div>
  </div>
</div>
<div>
<?php print render($content['flippy_pager']); ?>
</div>
</div>
