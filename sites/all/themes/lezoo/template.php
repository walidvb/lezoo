<?php 

setlocale(LC_ALL, 'fr_FR');

/**
 * @file template.php
 */
function lezoo_preprocess_html(&$variables) {
	drupal_add_css('//cdnjs.cloudflare.com/ajax/libs/animate.css/2.0/animate.min.css', array('type' => 'external'));
	drupal_add_js('//netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js', array('type' => 'external'));
	if(isset($variables['user']->roles['3']))
	{
		$variables['classes_array'][] = $variables['user']->roles['3'];
	}

}

function lezoo_preprocess_page(&$variables) {
	if(!empty($variables['node']))
	{
		dpm($variables['node']);
		switch($variables['node']->type)
		{
			case 'event':
				menu_set_active_item('agenda');
				break;
			case 'installations':
				menu_set_active_item('visu');
				break;
			case 'blog_post':
				dpm($variables['node']->field_section['und']['0']['tid']);
				switch($variables['node']->field_section['und']['0']['tid'])
				{
					case 28:
						menu_set_active_item('podcasts');
						break;
					case 27:
						menu_set_active_item('visu');
						break;
				}
				break;
		}
	}
}

/**
 * Implements hook_preprocess().
 */
function lezoo_preprocess_node(&$variables) {
	//dpm($variables);
	$variables['title_attributes_array']['class'] = 'node-title';
	$variables['left_col_classes'] = "col-lg-5 col-md-4 col-sm-3 col-xs-12 pinned";
	$variables['right_col_classes'] = "col-lg-7 col-md-8 col-sm-9 col-xs-12";
	$variables['theme_hook_suggestions'][] = 'node__' . $variables['type'] . '__' . $variables['view_mode'];
	$variables['submitted'] = '<span class="user">'. $variables['user']->name . '</span><span class="timestamp">' . strftime('%d/%m/%Y', $variables['created']) . '</span>';
	if(!$variables['is_front'])
	{
		if($variables['type'] == 'event')
		{
			$variables['ics'] = l('Ajouter au calendrier', base_path() . 'events/'. $variables['nid'] . '/' . $variables['title'] . '.ics', array('attributes' => array('class' => 'event-ics')));
		}
		else if($variables['type'] == 'installations')
		{
			$event_ref_label = t("Vu à la soirée");
			$variables['content']['field_event_ref']['#title'] = $event_ref_label;
		}
		else if($variables['type'] == 'blog_post')
		{
			if($variables['view_mode'] == 'full')
			{
				//dpm($variables);
				//add related items to the views
				$section = $variables['field_section']['und']['0']['tid'];
				$genres;
				$tags;
				foreach($variables['field_music_genre'] as $genre)
				{
					$parents = taxonomy_get_parents($genre['tid']);
					if(!empty($parents))
					{
						$parent = current($parents)->tid;
						$new = $parent;
					}
					else
					{
						$new = $genre['tid'];
					}
					$genres .= $new . '+';
				}
				foreach($variables['field_tags'] as $tag)
				{
					$tags .= $tag['tid'] . '+';
				}
				$genres = empty($genres) ? null : $genres;
				$tags = empty($tags) ? null : $tags;
				$related = views_embed_view('related', 'default', $variables['nid'], $section, $genres, $tags);
				$variables['related'] = $related;
			}
			if($variables['field_section']['und']['0']['tid'] == 28)
			{
				$event_ref_label = t("Entendu à la soirée");
			}
			else
			{
				$event_ref_label = t("Vu à la soirée");
			}
			$variables['content']['field_event_ref']['#title'] = $event_ref_label;

		}
	}
}

//set youtube frame width to 100%
function lezoo_video_filter_iframe(&$variables) {
	$video = $variables['video'];
	$video['width'] = '100%';
	$video['height'] = '350';
	$classes = video_filter_get_classes($video);
	$output = '<iframe src="' . $video['source'] . '" width="' . $video['width'] . '" height="' . $video['height'] . '" class="video-filter ' . implode(' ', $classes) . '" frameborder="0"></iframe>';
	return $output;
}


/**
 * Bootstrap theme wrapper function for the primary menu links.
 */
function lezoo_menu_tree__primary(&$variables) {
	return '<ul class="menu nav navbar-nav primary">' . $variables['tree'] . '</ul>';
}

function lezoo_image(&$variables){

	$variables['attributes']['class'] = 'img-responsive';
	return theme_image($variables);
}

//---------------------- Field Collection
/**
 * Creates a simple text rows array from a field collections, to be used in a
 * field_preprocess function.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 *
 * @param $field_name
 *   The name of the field being altered.
 *
 * @param $field_array
 *   Array of fields to be turned into rows in the field collection.
 */

function rows_from_field_collection(&$vars, $field_name, $field_array) {
	$vars['rows'] = array();
	foreach($vars['element']['#items'] as $key => $item) {
		$entity_id = $item['value'];
		$entity = field_collection_item_load($entity_id);
		$wrapper = entity_metadata_wrapper('field_collection_item', $entity);
		$row = array();
		foreach($field_array as $field){
			$row[$field] = $wrapper->$field->value();
		}
		$vars['rows'][] = $row;
	}
}

function lezoo_preprocess_field(&$vars, $hook){
	//dpm($vars);
	if ($vars['element']['#field_name'] == 'field_artist' || $vars['element']['#field_name'] =='field_vjs') {
		$vars['theme_hook_suggestions'][] = 'field__artist_collection';
		$field_array = array('field_artist_name', 'field_label','field_origin', 'field_link', 'field_artist_details');
		rows_from_field_collection($vars, $vars['element']['#field_name'], $field_array);
	}
}
