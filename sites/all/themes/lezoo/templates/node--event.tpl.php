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
dpm($content);

?>
<div class='node-event <?php print $classes ?>' <?php print $attributes; ?> >
	<div class='col-mds-12'>
		<div class='event-node dated-node'>
			<div class='header'>
				<div class='event-day day'> <?php print $day ?> </div>
				<div class='event-date date'> <?php print $date ?> </div>
				<span class='event-genre genre'> <?php print render($content['field_music_genre']); ?></span>
				<div class='event-title title'> 
					  <?php print render($title_prefix); ?>
						<h1><?php print l($title, 'node/'.$node->nid); ?></h1>
					  <?php print render($title_suffix); ?>
				</div>
			</div>
			<div class="event-body">
				<fig class="event-flyer">
					<?php print render($content['field_flyer']); ?>
				</fig>
				<?php print render($content['body']); ?>
			</div>

			<div class="event-details">
				<?php print render($content['field_details']); ?>
			</div>

			<div class='event-line-up event-line-up-djs line-up'> <?php print render($content['field_artist']); ?></div>
			<div class='event-line-up event-line-up-vjs line-up'> <?php print render($content['field_vjs']); ?></div>
		</div>
	</div>
</div>

