<?php 
$image = $fields['field_big_image']->content;
$title = $fields['field_subtitle']->content;
<<<<<<< HEAD
$description = $fields['title']->content;
$description .= $fields['field_music_genre']->content;
$description .= $fields['field_date']->content;
$description .= $fields['field_artist']->content;

?>
<?php print $image ?>
=======
$event_title = '<div class="banner-title">' . $fields['title']->content . $fields['field_music_genre']->content . '</div>';
$description .= $event_title;
$description .= $fields['field_date']->content;
$description .= $fields['field_artist']->content;
>>>>>>> artists

$link = 'node/' . $fields['nid']->content;


$slide = $image;

if(!empty($title) || !empty($description))
{
  $slide .= '<div class="carousel-caption">';
    if (!empty($title))
    {
		$slide .= $title;
    }

	if (!empty($description))
	{
       $slide .= $description;
    }
  $slide .= '</div>';
}
print l($slide, $link, array(
	'html' => true,
	));
?>
