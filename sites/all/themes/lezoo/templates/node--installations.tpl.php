<?php

if(isset($content['field_tags']))
{

  $tags = $content['field_tags'];
  hide($content['field_tags']);
}
else
{
  $tags = '';
}

hide($content['field_photos']);
hide($content['field_video']);
if(!$page)
{
  $title_tag = 'h3';
}
else
{
  $title_tag = 'h1';
}

// We hide the comments and links now so that we can render them later.
hide($content['comments']);
hide($content['links']);
?>
<?php print render($content['flippy_pager']); ?>

<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <div class="content"<?php print $content_attributes; ?>>
    <div class='header install-header'>
          <div class="install-titles">
            <div class='install-title title'> 
              <?php print render($title_prefix); ?>
                <h1 <?php print $title_attributes; ?>><?php print $title; ?></h1>
              <?php print render($title_suffix); ?>
            </div>
          </div>
          <div class="install-meta">
            <?php if($view_mode == 'full'): ?>
              <div class="install-social">
              <?php print $share42 ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
    <div class="<?php print $left_col_classes?>">
      <?php print render($content['field_video']); ?>
      <?php print render($content) ?>
    </div>
    <div class="<?php print $right_col_classes?>">
      <?php lezoo_header('Les Photos') ?>
      <div id="install-photos">
        <div class="swipe-wrap">
          <?php print render($content['field_photos']) ?>
        </div>
      </div>
    </div>
  </div>
  <?php print render($content['links']); ?>
</div>
