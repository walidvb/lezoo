<div class='node-event <?php print $classes ?>' <?php print $attributes; ?> >
	<?php print render($title_suffix); ?>
	<a href="<?php print drupal_get_path_alias($node_url)?>">
		<div>
			<div class='event-node dated-node'>
 			<div class="node-content">
					<div class='header'>
						<div class="event-meta">
							<div class='event-genre genre'><?php print render($content['field_music_genre']); ?></div>
						</div>
						<div class="event-titles">
							<div class='event-title title'> 
								<h2 <?php print $title_attributes; ?>><?php print $title ?></h2>
							</div>
						</div>
					<?php print render($content['field_date']) ?>
					</div>
					<div class="event-line-up">
						<div class='event-line-up event-line-up-djs line-up'> <?php print render($content['field_artist']); ?>
						</div>
						<?php if(!empty($content['field_vjs'])): ?>
							<div class='event-line-up event-line-up-vjs line-up'>
								<span class="vjs-label">
									Visuels: 
								</span>
								<?php print render($content['field_vjs']); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>

			</div>
		</div>
	</a>		
</div>

