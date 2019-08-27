<?php
	$background_image = lezoo_2019_get_img_url('banner_mobile', 'field_big_image', $node);
?>
<div class='node-event <?php print $classes ?>' <?php print $attributes; ?> >
		<div class='event-header'>
				<h2><?php print render($content['field_date']) ?></h2>
				<?php if(!$teaser): ?>
					<div class='event-genre genre'>
						<?php if(!empty($content['field_field_event_type'])): ?>
							<?php print render($content['field_field_event_type']) ; ?>
						<?php else: ?>
							 <?php print render($content['field_music_genre']) ; ?>
						<?php endif; ?>
				</div>
			</div>
			<div class="event-titles">
				<?php print render($content['field_subtitle']) ?>
				<?php endif; ?>
				<div class='event-title title'>
					<?php print render($title_prefix); ?>
					<h1 <?php print $title_attributes; ?>><?php print $title ?></h1>
					<?php print render($title_suffix); ?>
				</div>
			</div>
		</div>
		<div class='event-node dated-node'>
			<div class="node-content">
				<!-- <?php print render($content['field_big_image']) ?> -->
				<div class="closable">
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
						<div class="row">
						  	<div class="<?php print $right_col_classes ?> pull-right">
						  		<div class="event-details">
									<?php print render($content['field_details']); ?>
								</div>
									<div class="event-body">
										<?php print render($content['body']); ?>
									</div>
							</div>
							<div class="event-meta">
								<?php if($view_mode == 'full'): ?>
									<div class="event-social">
										<?php print $ics; ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	<?php print render($content['flippy_pager']); ?>
</div>
