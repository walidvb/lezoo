<div class='node-event <?php print $classes ?> <?php print(empty($content['field_subtitle']) ? null : "has-subtitle")?>' <?php print $attributes; ?> >
	<?php print render($title_suffix); ?>
	<a href="<?php print drupal_get_path_alias($node_url)?>">
		<div>
			<div class='event-node dated-node'>
 			<div class="node-content">
					<div class='event-header'>
						<?php print render($content['field_date']) ?>
						<div class="event-meta">
							<div class='event-genre genre'>
								<?php if(!empty($content['field_field_event_type'])): ?>
									<?php print render($content['field_field_event_type']) ; ?>
								<?php else: ?>
									 <?php print render($content['field_music_genre']) ; ?>
								<?php endif; ?>
						</div>
						</div>

					</div>
					<div class="event-titles">
						<div class='event-title title'>
							<h3 <?php print $title_attributes; ?>><?php print $title ?></h3>
						</div>
					<?php if(!empty($content['field_subtitle'])): ?>
						<div class="event-subtitle">
							<?php print render($content['field_subtitle']) ?>
						</div>
					<?php endif; ?>
					</div>
					<div class="event-line-up">
						<h4 div class='event-line-up-djs line-up'> <?php print render($content['field_artist']); ?>
						<h4 div class='event-line-up-djs line-up'> <?php print render($content['field_artist_name']); ?>
						</div>
						<?php if(!empty($content['field_vjs'])): ?>
							<div class='event-line-up-vjs line-up'>
								<span class="vjs-label">
									Vjs:
								</span>
								<?php print render($content['field_vjs']); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
	</a>
</div>
