<?php 
$image_url = trim($fields['field_big_image']->content);
$image = "<figure class=\"field-big-image\"><img class=\"img-responsive\" src=\"" . $image_url . "\" width=\"1140\" height=\"360\" alt=\"\" />  </figure>";
$mobile_banner = $fields['field_big_image_1']->content;

if(isset($fields['field_subtitle']))
{
  $title = $fields['field_subtitle']->content;
}
$event_title = '<div class="banner-title">' . $fields['title']->content . $fields['field_music_genre']->content . '</div>';
$description = $event_title;
$description .= $fields['field_date']->content;
$description .= $fields['field_artist']->content;


$link = 'node/' . $fields['nid']->content;

$caption = null;
if(!empty($title) || !empty($description))
{
  $caption .= '<div class="carousel-caption">';
    if (!empty($title))
    {
		$caption .= $title;
    }

	if (!empty($description))
	{
       $caption .= $description;
    }
  $caption .= '</div>';
}
$slide = $image . l($caption, $link, array(
    'html' => true,
    ));
?>


<div class="carousel-wrapper" style="background-image: url('<?php print $mobile_banner ?>')">

  
  <?php print $slide
  ?>
</div>
