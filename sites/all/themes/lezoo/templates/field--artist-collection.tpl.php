<?php
/**
 *  Field formatter for the field_achievements field collection.
 */
?>
<div class="artists">
	<?php foreach($rows as $row): ?>
	<?php 
		$name = (!empty($row['field_link']) && !$view_mode) ? l($row['field_artist_name']->name, $row['field_link']['url'], array('attributes' => $row['field_link']['attributes'])) : $row['field_artist_name']->name;
		$origins = array();
		foreach($row['field_origin'] as $origin)
		{
			if(!empty($origin))
			{
				$origins[] = $origin->name;
			}
		}
		$origins_markup = null;
		if(!empty($origins))
		{
			$origins_markup = '<span class="artist-origin">' . implode(', ', $origins) . '</span>';
		}

		$labels = array();
		foreach($row['field_label'] as $label)
		{
			$labels[] = $label->name;
		}
		$labels_markup = null;
		if(!empty($labels))
		{
			$labels_markup = '<span class="artist-labels">' . implode(', ', $labels) . '</span>';
		}

		$infos = array($labels_markup, $origins_markup);
		$infos = array_filter($infos, 'strlen');
		$info = implode( ' / ',  $infos);
	?>
	<div class="artist artist-item">
	<span class="artist-name">
	<?php print $name;?>
</span>
<?php if(!empty($row['field_artist_details'])): ?>
	<span class="artist-additional-info">
		<?php print $row['field_artist_details'] ?>
	</span>
<?php endif; ?>
	<?php if(!empty($infos)): ?>
	<span class="artist-info">
		<?php print '(' . $info . ')'; ?>
	</span>
<?php endif; ?>
</div>
<?php endforeach; ?>
</div>