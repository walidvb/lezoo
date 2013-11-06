<?php
/**
 *  Field formatter for the field_achievements field collection.
 */
?>
<div class="artists">
	<?php foreach($rows as $row): ?>
	<div class="artist">
		<span class="artist-name">
			<?php 
			if(isset($row['field_link']))
			{
				print l($row['field_artist_name']->name, $row['field_link']['url'], array('attributes' => $row['field_link']['attributes']));
			}
			else
			{
				print($row['field_artist_name']->name);
			} 
			?></span>
			<?php $i = 0; ?>
			<?php foreach($row['field_label'] as $label): ?>
			<?php if($i++ > 0){print ', ';}else{print '(';} ?> 
			<span class="artist-labels"><?php print $label->name ?></span>
		<?php endforeach ?>
		/ <span class="artist-origin"><?php print $row['field_origin']->name; ?></span>)
	</div>
<?php endforeach; ?>
</div>