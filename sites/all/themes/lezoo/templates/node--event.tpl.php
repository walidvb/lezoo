<?php 
	$background_image = get_img_url('banner_mobile', 'field_big_image', $node);
?>
<div class='node-event <?php print $classes ?>' <?php print $attributes; ?> >
		<div class='header' style="background-image: url('<?php print $background_image ?>')">
			<div class="event-titles">
				<?php if(!$teaser): ?>
					<div class='event-genre genre'><?php print render($content['field_music_genre']); ?></div>
					<div class="event-subtitle">
						<?php print render($content['field_subtitle']) ?>
					</div>
				<?php endif; ?>
				<div class='event-title title'> 
					<?php print render($title_prefix); ?>
					<h1<?php print $title_attributes; ?>><?php print $title ?></h1>
					<?php print render($title_suffix); ?>
				</div>
			</div>
			<div class="event-meta">
				<?php if($view_mode == 'full'): ?>
					<div class="event-social">
					<?php print $share42 . $ics; ?>
					</div>
				<?php endif; ?>
			</div>
		<?php print render($content['field_date']) ?>
		</div>
		<div class='event-node dated-node'>
			<div class="node-content">
				<?php print render($content['field_big_image']) ?>
				<div class="closable">
					<?php print lezoo_header('Le Line up'); ?>
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
				<?php if(!$teaser): ?>
					<div class="closable">
						<?php print lezoo_header('Les Détails'); ?>
						<div class="row">
						  	<div class="<?php print $right_col_classes ?> pull-right">
						  		<div class="event-details">
									<?php print render($content['field_details']); ?>
								</div>
									<div class="event-body">
										<?php print render($content['body']); ?>
									</div>
							</div>
							<div class="<?php print $left_col_classes ?> pull-left">
						  		<fig class="event-flyer">
										<?php print render($content['field_flyer']); ?>
								</fig>
						  	</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	<?php print render($content['flippy_pager']); ?>
</div>
