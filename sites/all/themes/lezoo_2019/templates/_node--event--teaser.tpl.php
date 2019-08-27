<?php 

global $now;

$display_day = array('settings' => array('format_type' => 'day'));

$day = field_view_field('node', $node, 'field_date', $display_day);

$display_date = array('settings' => array('format_type' => 'day_number'));

$date = field_view_field('node', $node, 'field_date', $display_date);


if($now < 4 && 0)
{
	dpm('newnode');
	dpm($node);
	$now++;
	dpm($date);
	dpm($day);
}

$day['#label_display'] = 'hidden';
$date['#label_display'] = 'hidden';
$date = render($date);
$day = render($day);
?>
<div class='node-event <?php print $classes ?>' <?php print $attributes; ?> >
	<div class='col-mds-12'>
		<div class='event-item dated-node'>
			<div class="date">
				<div class='event-day day'> <?php print $day ?> </div>
				<div class='event-date number'> <?php print $date ?> </div>
			</div>
			<span class='event-genre genre'> <?php print render($content['field_music_genre']); ?></span>
			<div class="event-details">
				<div class='header'>
					<div class='event-title title'> 
						  <?php print render($title_prefix); ?>
							<h2><?php print l($title, 'node/'.$node->nid); ?></h2>
						  <?php print render($title_suffix); ?>
					</div>
				</div>



				<div class='event-line-up event-line-up-djs line-up'> <?php print render($content['field_artist']); ?></div>
				<div class='event-line-up event-line-up-vjs line-up'> <?php print render($content['field_vjs']); ?></div>
			</div>
		</div>
	</div>
</div>

