<?php 

	$url = drupal_get_path_alias($node_url);
	$type_field_name = !empty($content['field_field_event_type']) ? 'field_field_event_type' : 'field_music_genre';
	$type = render($content[$type_field_name]);
	$date = render($content['field_date']);
	$title_ = "<h4 $title_attributes>$title</h4>";
	$subtitle = !empty($content['field_subtitle']) ? render($content['field_subtitle']) : null;
	$subtitle_class = empty($content['field_subtitle']) ? null : "has-subtitle";
	$djs = render($content['field_artist']);
	$vjs = !empty($content['field_vjs']) ? render($content['field_vjs']) : null;
	$event_type_tid = $content['field_field_event_type']['#items'][0]['tid'];
	// if not COLLAB'
	if($event_type_tid != 4261){
		$title_ = null;
	}
?>

<div data-nid="<?php print $nid; ?>" class='node-event <?php print $classes ?> <?php print($subtitle_class)?>' <?php print $attributes; ?> >
	<?php print render($title_prefix); ?>
	<?php print render($title_suffix); ?>
	<a href="<?php print $url?>">
		<div class="node-content">
			<div class='event-header'>
				<div class='event-genre genre'> <?php print $type ?></div>
				<div class="event-titles">
					<div class='event-title title'><?php print $title_ ?></div>
				</div>
			</div>
			<div class="event-main">
				<?php print $date; ?>
				<div class="event-line-up">
					<div class='event-line-up-djs line-up'> <?php print $djs; ?></div>
					<?php if($vjs): ?>
						<div class='event-line-up-vjs line-up'>
							<span class="vjs-label"> Vjs: </span>
							<?php print $vjs; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</a>
</div>
