<?php 
	$background_image = get_img_url('banner', 'field_big_image', $node);
?>
<div class='node-event <?php print $classes ?>' <?php print $attributes; ?> >
		<div class='event-node dated-node'>
			<div class="node-content">
				<div class='header' style="background-image: url('<?php print $background_image ?>')">
					<div class="event-titles">
						<div class='event-title title'> 
							<?php print render($title_prefix); ?>
							<?php print l("<h2 $title_attributes>$title</h2>", 'node/' .$node->nid,  array('html' => true)); ?>
							<?php print render($title_suffix); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php print render($content['flippy_pager']); ?>
</div>
