<?php
/**
 * @file
 * Display Suite 3 cols bootstrap template.
 *
 * Available variables:
 *
 * Layout:
 * - $classes: String of classes that can be used to style this layout.
 * - $contextual_links: Renderable array of contextual links.
 * - $layout_wrapper: wrapper surrounding the layout.
 *
 * Regions:
 *
 * - $left: Rendered content for the "Left" region.
 * - $left_classes: String of classes that can be used to style the "Left" region.
 *
 * - $middle: Rendered content for the "Middle" region.
 * - $middle_classes: String of classes that can be used to style the "Middle" region.
 *
 * - $right: Rendered content for the "Right" region.
 * - $right_classes: String of classes that can be used to style the "Right" region.
 */
?>
<<?php print $layout_wrapper; print $layout_attributes; ?> class="<?php print $classes;?> clearfix">

<!-- Needed to activate contextual links -->
<?php if (isset($title_suffix['contextual_links'])): ?>
  <?php print render($title_suffix['contextual_links']); ?>
<?php endif; ?>
<div>
  <<?php print $right_wrapper; ?> class="ds-right col-md-2 col-sm-3 col-xs-12 pull-right <?php print $right_classes; ?>">
  <?php print $right; ?>
  </<?php print $right_wrapper; ?>>

  <div class="ds-middle col-md-5 col-sm-9 col-xs-12 pull-right <?php print $middle_classes; ?>">
    <div class="h2 visible-xs"> <?php print t('Le Groupe') ?> </div>
    <<?php print $middle_wrapper; ?> >
    <?php print $middle; ?>
    </<?php print $middle_wrapper; ?>>
  </div>

  <div class="ds-left col-md-5 col-sm-12 col-xs-12 pull-left<?php print $left_classes; ?>">
    <div class="h2 visible-xs"> <?php print t('Les Photos') ?> </div>
    <<?php print $left_wrapper; ?> >
    <?php print $left; ?>
    </<?php print $left_wrapper; ?>>
  </div>
   <div class="ds-bottom col-md-5 col-sm-12 col-xs-12 col-md-offset-5 <?php print $bottom_classes; ?>">
    <<?php print $bottom_wrapper; ?> >
    <?php print $bottom; ?>
    </<?php print $bottom_wrapper; ?>>
  </div>
</div>
</<?php print $layout_wrapper ?>>

<!-- Needed to activate display suite support on forms -->
<?php if (!empty($drupal_render_children)): ?>
  <?php print $drupal_render_children ?>
<?php endif; ?>
