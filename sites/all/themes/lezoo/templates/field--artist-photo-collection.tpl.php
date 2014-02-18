<?php
/**
 *  Field formatter for the field_artists field collection.
 */
?>
 <div class="artist-list">
	<?php foreach($rows as $row): ?>
		<?php print l($row['field_artist_name']->name, 'node/' . $row['field_artist_ref']->nid, array(
			'attributes' => array(
				'class' => "artist-list-item",
				'data-img' => get_img_url('artist_list', 'field_artist_img', $row['node'])
				)
		)); ?>
	<?php endforeach; ?>
</div>