<?php 

global $now;

if($now < 4 && 0)
{
	dpm('newnode');
	dpm($node);
	$now++;
	dpm($date);
	dpm($day);
}

if(!$page)
{
	$title_tag = 'h3';
}
else
{
	$title_tag = 'h1';
}
?>
<div class='node-event <?php print $classes ?>' <?php print $attributes; ?> >
	<div class='col-mds-12'>
		<div class='event-node dated-node'>
			<?php print render($content['field_date']) ?>
			<div class="node-content">
				<div class='header'>
					<div class="event-subtitle">
						<?php print render($content['field_subtitle']) ?>
					</div>
					<span class='event-genre genre'> <?php print render($content['field_music_genre']); ?></span>
					<div class='event-title title'> 
						<?php print render($title_prefix); ?>
						<<?php print $title_tag; print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></<?php print $title_tag?>>
						<?php print render($title_suffix); ?>
						<?php if($view_mode == 'full'): ?>
						<div class="event-meta">
							<?php print render($content['field_addthis']) ?>
							<?php if(!empty($ics) && $view_mode != 'mini')
							print $ics; 
							?>
						</div>
						<?php endif; ?>
					</div>
				</div>

				<div class='event-line-up event-line-up-djs line-up'> <?php print render($content['field_artist']); ?></div>
				<?php if(!empty($content['field_vjs'])): ?>
					<div class='event-line-up event-line-up-vjs line-up'> <?php print render($content['field_vjs']); ?></div>
				<?php endif; ?>

				<?php if(!$teaser): ?>
					<div class="event-details col-md-5 col-xs-12 col-sm-5">
						<?php print render($content['field_details']); ?>
					</div>
					<div class="event-body">
						<fig class="event-flyer">
							<?php print render($content['field_flyer']); ?>
						</fig>
						<?php print render($content['body']); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

