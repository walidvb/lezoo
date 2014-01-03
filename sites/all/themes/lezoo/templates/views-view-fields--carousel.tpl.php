<?php 
$image = $fields['field_big_image']->content;
if(isset($fields['field_subtitle']))
{
  $title = $fields['field_subtitle']->content;
}
$event_title = '<div class="banner-title">' . $fields['title']->content . $fields['field_music_genre']->content . '</div>';
$description = $event_title;
$description .= $fields['field_date']->content;
$description .= $fields['field_artist']->content;


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
