
<?php 

?>
<div class='node-event <?php print $classes ?>' <?php print $attributes; ?> >
	<div>
		<div class='event-node dated-node'>
			<?php print render($content['flippy_pager']); ?>
			<div class="node-content">
				<div class='header'>
					<div class="event-meta">
						<?php if($view_mode == 'full'): ?>
							<div class="event-social">
							<?php print $share42 . $ics; ?>
							</div>
						<?php endif; ?>
						<div class='event-genre genre'><?php print render($content['field_music_genre']); ?></div>
					</div>
					<div class="event-titles">
						<?php if(!$teaser): ?>
							<div class="event-subtitle">
								<?php print render($content['field_subtitle']) ?>
							</div>
						<?php endif; ?>
						<div class='event-title title'> 
							<?php print render($title_prefix); ?>
							<h1<?php print $title_attributes; ?>><?php print l($title,$node_url) ?></h1>
							<?php print render($title_suffix); ?>
						</div>
					</div>
					
				<?php print render($content['field_date']) ?>
				</div>
				<?php print render($content['field_big_image']) ?>
				<?php print lezoo_header('Le Line up'); ?>
				<div class="event-line-up">
					<div class='event-line-up event-line-up-djs line-up'> <?php print render($content['field_artist']); ?>
					</div>
					<?php if(!empty($content['field_vjs'])): ?>
						<div class='event-line-up event-line-up-vjs line-up'> <?php print render($content['field_vjs']); ?>
						</div>
					<?php endif; ?>
				</div>
				<?php if(!$teaser): ?>
					<?php print lezoo_header('Les Détails'); ?>
					<div>
					  	<div class="<?php print $left_col_classes ?>">
					  		<fig class="event-flyer">
									<?php print render($content['field_flyer']); ?>
							</fig>
					  	</div>
					  	<div class="<?php print $right_col_classes ?>">
					  		<div class="event-details">
								<?php print render($content['field_details']); ?>
							</div>
								<div class="event-body">
									<?php print render($content['body']); ?>
								</div>
						</div>
					</div>
				<?php endif; ?>
			</div>

		</div>
	</div>
</div>

