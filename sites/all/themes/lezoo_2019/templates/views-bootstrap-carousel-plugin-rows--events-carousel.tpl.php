<?php $slide = $image;
if (!empty($title) || !empty($description))
{
	$slide .= '<div class="carousel-caption">';
	if (!empty($title))
	{
		$slide .= "<h5>$title</h5>";
	}

<?php if (!empty($title) || !empty($description)): ?>
  <div class="carousel-caption">
    <?php if (!empty($title)): ?>
      <h5><?php print $title ?></h5>
    <?php endif ?>

    <?php if (!empty($description)): ?>
      <?php print $description ?>asd
    <?php endif ?>
  </div>
<?php endif ?>
	if (!empty($description))
	{
		$slide .= $description;
	}
	$slide .= "</div>";
}
?>
