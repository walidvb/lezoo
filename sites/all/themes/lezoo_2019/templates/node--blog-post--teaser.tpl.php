<?php
  hide($content['links']);
?>

<div data-nid="<?php print $node->nid; ?>" id="node-<?php print $node->nid; ?>" class="<?php print $classes ?> clearfix"<?php print $attributes; ?> >
    <div class="news-teaser">
      <?php print render($title_prefix); ?>
      <a href="<?php print $node_url; ?>">
        <div class="news-title">
          <h4 <?php print $title_attributes; ?>><?php print $title; ?></h4>
        </div>
      </a>
      <?php print render($title_suffix); ?>
      <a href="<?php print $node_url; ?>">
        <?php print render($content); ?>
      </a>
    </div>
</div>
