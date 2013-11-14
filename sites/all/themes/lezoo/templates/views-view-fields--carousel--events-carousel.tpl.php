<?php 
$image = $fields['field_big_image']->content;
$title = $fields['field_subtitle']->content;
$description = $fields['title']->content;
$description .= $fields['field_date']->content;
$description .= $fields['field_artist']->content;
?>
<?php print $image ?>

<?php if (!empty($title) || !empty($description)): ?>
  <div class="carousel-caption">
    <?php if (!empty($title)): ?>
      <?php print $title ?>
    <?php endif ?>

    <?php if (!empty($description)): ?>
      <?php print $description ?>
    <?php endif ?>
  </div>
<?php endif ?>