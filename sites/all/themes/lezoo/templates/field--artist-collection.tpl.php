<?php
/**
 *  Field formatter for the field_achievements field collection.
 */
?>
<div class="artists">
	<?php foreach($rows as $row): ?>
	<div class="artist artist-item">
		<?php 
		$name = !empty($row['field_link']) ? l($row['field_artist_name']->name, $row['field_link']['url'], array('attributes' => $row['field_link']['attributes'])) : $row['field_artist_name']->name;
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

			if(!empty($row['field_origin']))
			{
				$info .= '<span class="artist-origin">' . $row['field_origin']->name . '</span>';
			}

			$info .= ')';
			?>
			<div class="artist">
				<span class="artist-name">
					<?php print $name;?>
				</span>
				<span class="artist-info">
					<?php print $info ?>
				</span>
			</div>
		</div>
	<?php endforeach; ?>
</div>