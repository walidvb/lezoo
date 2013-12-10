<?php
/**
 *  Field formatter for the field_achievements field collection.
 */
dpm($element);
$teaser = $element['#view_mode'];
?>
<div class="artists">
	<?php foreach($rows as $row): ?>
	<div class="artist artist-item">
		<?php 
		$name = !empty($row['field_link']) ? l($row['field_artist_name']->name, $row['field_link']['url'], array('attributes' => $row['field_link']['attributes'])) : $row['field_artist_name']->name;
		$bracketContent = !empty($row['field_label']) && !empty($row['field_origin']);
		$info = '(';
			$i = 0;
			if(!empty($row['field_label']))
			{
				foreach($row['field_label'] as $label)
				{
					$info .= '<span class="artist-labels">' .$label->name . '</span>';
					if(++$i > 0 && $i != count($row['field_label'])) {$info .= ', ';}
				}
			}
			if(!empty($row['field_origin']) && !empty($row['field_label']))
			{
				$info .= ' / ';
			}

			if(!empty($row['field_origin']) && isset($row['field_origin']->name) )
			{
				$info .= '<span class="artist-origin">' . $row['field_origin']->name . '</span>';
			}

			$info .= ')';
			?>
			<span class="artist-name">
				<?php print $name;?>
			</span>
			<?php if(!empty($row['field_artist_details'])): ?>
				<span class="artist-additional-info">
					<?php print $row['field_artist_details'] ?>
				</span>
			<?php endif; ?>
			<?php if($bracketContent): ?>
				<span class="artist-info">
					<?php print $info ?>
				</span>
			<?php endif; ?>
	</div>
	<?php endforeach; ?>
</div>