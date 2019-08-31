<?php
/**
* @file template.php
*/
function lezoo_2019_preprocess_html(&$variables) {
	$meta['mobile'] = array(
		'name' => "apple-mobile-web-app-capable",
		'content' => "yes");
	$meta['startup_image'] = array(
		'rel' => "apple-touch-startup-image",
		'href' => "/sites/all/themes/lezoo/img/startup_image.png");
	$meta['ios_icon'] = array(
		'rel' => "apple-touch-icon",
		'href' => "/sites/all/themes/lezoo/img/webApp_logo.png");
	$meta['ios_app_name'] = array(
		'name' => "apple-mobile-web-app-title",
		'content' => "le ZOO");
	foreach($meta as $key => $tag)
	{
		drupal_add_html_head(array(
		'#tag' => 'meta',
		'#attributes' => $tag)
	, $key);
	}
	drupal_add_js('//cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.4/jquery.touchSwipe.min.js', array('type' => 'external'));
	drupal_add_js('//cdnjs.cloudflare.com/ajax/libs/angular.js/1.1.1/angular.min.js', array('type' => 'external', 'scope' => 'footer'));
	drupal_add_js(drupal_get_path('theme', 'lezoo_2019'). '/js/myAngular.js', array('scope' => 'footer'));

	$date = new DateTime("now", new DateTimeZone('Europe/Amsterdam') );
	$hour = $date->format('H');
	$variables['is_night'] = $hour >= 18 || $hour <= 6;
	if(isset($variables['user']->roles['3']))
	{
		$variables['classes_array'][] = $variables['user']->roles['3'];
	}
}
/**
* @file
* menu-link.func.php
*/
/**
* Overrides theme_menu_link().
*/
function lezoo_2019_menu_link(array $variables) {
	$element                           = $variables['element'];
	$element['#attributes']['class'][] = strtolower($element['#title']);
	return theme_menu_link($variables);
}

function lezoo_2019_preprocess_page(&$variables) {
	$footer_mobile = module_invoke('block', 'block_view', '7');
	$variables['footer_mobile'] = $footer_mobile['content'];
	if(!empty($variables['node']))
	{
		$menu_active_item = null;
		switch($variables['node']->type)
		{
			case 'event':
				$menu_active_item ='agenda';
				break;
			case 'installations':
				$menu_active_item ='visu';
				break;
			case 'blog_post':
				$menu_active_item ='news';
				break;
			// switch($variables['node']->field_section['und']['0']['tid'])
			// {
			// 	case 28:
			// 	$menu_active_item ='news';
			// 	break;
			// 	case 27:
			// 	$menu_active_item ='visu';
			// 	break;
			// }
			// break;
		}
		if(!empty($menu_active_item))
		{
			menu_set_active_item($menu_active_item);
		}
	}
	else
	{
		switch($variables['theme_hook_suggestions'])
		{
			case 'page__visu':
			menu_set_active_item('visu');
			break;
		}
	}
}
/**
* Implements hook_preprocess().
*/
function lezoo_2019_preprocess_node(&$variables) {
	$variables['title_attributes_array']['class'] = 'node-title';
	$build['#contextual_links']['node'] = array('node', array($node->nid));
	$variables['classes_array'][] = 'view-mode-' . $variables['view_mode'];
	$node_status = array(
		'open' => 'node-open',
		'closed' => 'node-closed'
		);
	drupal_add_js(array('lezoo_theme' => array('node_status' => $node_status)), 'setting');
	$variables['is_page'] = !empty($variables['is_page']) ? $variables['is_page'] : false;
	$variables['classes_array'][] = (!empty($variables['is_page']) && $variables['is_page']) ? $node_status['open']. " node-full-page" : $node_status['closed'] . ' node-in-list';
	$variables['theme_hook_suggestions'][] = 'node__' . $variables['type'] . '__' . $variables['view_mode'];
	$variables['submitted'] = '<span class="timestamp">' . strftime('%d/%m/%Y', $variables['created']) . '</span>';
	if(!$variables['is_front'])
	{
		if($variables['type'] == 'event')
		{
			$nid = $variables['nid'];
			$title = 'event';
			$link = 'http://lezoo.ch/feed/'. $variables['nid'] . '/event-feed.ics';
			$variables['ics'] = '<div class="ics-container">' . l('Ajouter à mon calendrier', $link, array('attributes' => array(
				'id' => 'event-ics',
				"data-downloadurl" => "text/calendar:$title.ics:http://lezoo.ch/feed/$nid/event-feed.ics"
				))) . '</div>';
		}
		else if($variables['type'] == 'installations' && !empty($variables['content']['field_event_ref']))
		{
			$event_ref_label = t("Vu à la soirée");
			$variables['content']['field_event_ref']['#title'] = $event_ref_label;
		}
		else if($variables['type'] == 'blog_post')
		{
			// if($variables['view_mode'] == 'full')
			// {
			// 	//add related items to the views
			// 	$section = $variables['field_section']['und']['0']['tid'];
			// 	$genres = null;
			// 	$tags = null;
			// 	if(!empty($variables['field_music_genre']) && count($variables['field_music_genre']) != 0)
			// 	{
			// 		foreach($variables['field_music_genre'] as $genre)
			// 		{
			// 			$parents = taxonomy_get_parents($genre['tid']);
			// 			if(!empty($parents))
			// 			{
			// 				$parent = current($parents)->tid;
			// 				$new = $parent;
			// 			}
			// 			else
			// 			{
			// 				$new = $genre['tid'];
			// 			}
			// 			$genres .= $new . '+';
			// 		}
			// 	}
			// 	if(!empty($variables['field_tags']))
			// 	{
			// 		foreach($variables['field_tags'] as $tag)
			// 		{
			// 			$tags .= $tag['tid'] . '+';
			// 		}
			// 		$genres  = empty($genres) ? null : $genres;
			// 		$tags    = empty($tags) ? null : $tags;
			// 		$related = views_embed_view('related', 'default', $variables['nid'], $section, $genres, $tags);

			// 		if($related)
			// 		{
			// 			$related_block = "<aside class=\"related-posts\"><h3 class=\"block-title related-title\">". t('Encore plus') ."</h3>" . $related . "</aside>";
			// 			$variables['related'] = $related_block;
			// 		}
			// 	}
			// }
			if(!empty($variables['content']['field_event_ref']))
			{
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
}
//set video frame width to 100%
function lezoo_2019_video_filter_iframe(&$variables) {
	$video           = $variables['video'];
	$video['width']  = '100%';
	$video['height'] = '8rem';
	$classes         = video_filter_get_classes($video);
	$output          = '<iframe src="' . $video['source'] . '" width="' . $video['width'] . '" height="' . $video['height'] . '" class="video-filter ' . implode(' ', $classes) . '" frameborder="0"></iframe>';
	return $output;
}
function lezoo_2019_node_view_alter(&$build) {
  $node = $build['#node'];
  if (!empty($node->nid)) {
    $build['#contextual_links']['node'] = array('node', array($node->nid));
  }
}

function lezoo_2019_get_img_url($style, $field_name, $node){
	$field = $node->$field_name;
	$fid = $field['und'] ? $field['und'][0]['fid'] : $node->field_flyer['und'][0]['fid'];
	$file  = file_load($fid);
	return image_style_url($style, $file->uri);
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
		$entity    = field_collection_item_load($entity_id);
		$wrapper   = entity_metadata_wrapper('field_collection_item', $entity);
		$row       = array();
		foreach($field_array as $field){
			$row['node'] = $entity;
			$row[$field] = $wrapper->$field->value();
		}
		$vars['rows'][] = $row;
	}
}
function lezoo_2019_preprocess_field(&$vars, $hook){
	if ($vars['element']['#field_name'] == 'field_artist' || $vars['element']['#field_name'] =='field_vjs') {
		$vars['theme_hook_suggestions'][] = 'field__artist_collection';
		$vars['theme_hook_suggestions'][] = 'field__artist_collection__';
		$vars['teaser']                   = $vars['element']['#view_mode'] == 'teaser';
		$vars['view_mode']                = $vars['element']['#view_mode'];
		$field_array                      = array('field_artist_name', 'field_label','field_origin', 'field_link', 'field_artist_details');
		rows_from_field_collection($vars, $vars['element']['#field_name'], $field_array);
	}
	else if($vars['element']['#field_name'] == 'field_artist_photo')
	{
		$vars['theme_hook_suggestions'][] = 'field__artist_photo_collection';
		$vars['theme_hook_suggestions'][] = 'field__artist_photo_collection__';
		$vars['teaser']                   = $vars['element']['#view_mode'] == 'teaser';
		$vars['view_mode']                = $vars['element']['#view_mode'];
		$field_array                      = array('field_artist_name', 'field_artist_img', 'field_artist_ref');
		rows_from_field_collection($vars, $vars['element']['#field_name'], $field_array);
	}
}
function lezoo_2019_preprocess_media_soundcloud_audio(&$variables) {
	$variables['output'] = preg_replace('/visual=true/', '', $variables['output']);
}

function lezoo_2019_soundcloud_filter_embed_html5($variables) {
	$variables['sound']['width'] = "99.5%";
	$variables['sound']['autoplay'] = false;
	return theme_soundcloud_filter_embed_html5($variables);
}

function lezoo_2019_preprocess_image(&$vars){
	$vars['attributes']['loading'] = 'lazy';
}
