<?php $slide = $image;
if (!empty($title) || !empty($description))
{
	$slide .= '<div class="carousel-caption">';
	if (!empty($title))
	{
		$slide .= "<h5>$title</h5>";
	}

	if (!empty($description))
	{
		$slide .= $description;
	}
	$slide .= "</div>";
}
?>