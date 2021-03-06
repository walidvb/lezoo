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

$background_image = get_img_url('banner_mobile', 'field_big_image', $node);


hide($content['field_photos']);

if(!empty($content['field_media']))
{
  hide($content['field_media']);
}
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
hide($content['flippy_pager']);
?>
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
    <div class='header install-header' style="background-image: url('<?php print $background_image ?>')">
          <div class="install-titles">
            <div class='install-title title'> 
              <?php print render($title_prefix); ?>
                <h1 <?php print $title_attributes; ?>><?php print $title; ?></h1>
              <?php print render($title_suffix); ?>
            </div>
          </div>
        </div>
        <?php if(!empty($content['field_tags'])): ?>
            <div class="tags">
              <div class="field-tags">
                 <?php print render($content['field_tags']); ?>
              </div>
            </div>
         <?php endif; ?>
        <?php if($view_mode == 'full'): ?>
            <div class="install-social">
              <?php print $share42 ?>
            </div>
        <?php endif; ?>
        
    <div class="row">
      <div class="<?php print $right_col_classes?> pull-right">
        <div class="closable">
          <?php print lezoo_header('Les Images') ?>
          <div id="install-photos">
            <div class="swipe-wrap">
              <?php print render($content['field_photos']) ?>
            </div>
          </div>
        </div>
      </div>
      <div class="<?php print $left_col_classes?> pull-left">
        <?php if(!empty($content['field_media'])): ?>
          <div class="closable">
            <?php print lezoo_header('La video'); ?>
            <?php print render($content['field_media']); ?>
          </div>
        <?php endif; ?>
        <div class="closable">
          <?php print lezoo_header('Le Blabla'); ?>
          <div>
            <?php print render($content) ?>
          </div>
        </div>
      </div>
    </div>
  <?php print render($content['links']); ?>
  <?php print render($content['flippy_pager']); ?>
</div>
