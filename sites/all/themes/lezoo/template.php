<?php 


/**
* @file template.php
*/
function lezoo_preprocess_html(&$variables) {
	$meta['mobile'] = array(
		'name' => "apple-mobile-web-app-capable", 
		'content' => "yes");
	$meta['startup_image'] = array(
		'rel' => "apple-touch-startup-image", 
		'href' => "/sites/all/themes/lezoo/img/startup_image.png");
	$meta['ios_icon'] = array(
		'rel' => "apple-touch-icon-precomposed", 
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
	// drupal_add_js("var addToHomeConfig = {
	// 	animationIn: 'bubble',
	// 	animationOut: 'drop',
	// 	lifespan:5000,
	// 	expire:50,
	// 	touchIcon:true,
	// 	returningVisitor:false,
	// 	message: 'Ajoute le site du zoo comme webapp en appuyant sur %icon!'

	// };",  array('type' => 'inline', 'scope' => 'footer'));
	// drupal_add_js(drupal_get_path('theme', 'lezoo'). '/libs/addToHome/src/add2home.js', array('scope' => 'footer'));
	//drupal_add_css(drupal_get_path('theme', 'lezoo') . '/libs/addToHome/style/add2home.css');
	drupal_add_css(drupal_get_path('theme', 'lezoo') . '/libs/swiper/swiper.css');
	drupal_add_js(drupal_get_path('theme', 'lezoo'). '/libs/swiper/idangerous.swiper.js', array('scope' => 'footer'));
	drupal_add_js('//cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.4/jquery.touchSwipe.min.js', array('type' => 'external'));


	drupal_add_css('//cdnjs.cloudflare.com/ajax/libs/animate.css/2.0/animate.min.css', array('type' => 'external'));
	drupal_add_js('//netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js', array('type' => 'external'));
	drupal_add_js('//cdnjs.cloudflare.com/ajax/libs/angular.js/1.1.1/angular.min.js', array('type' => 'external', 'scope' => 'footer'));
	drupal_add_js(drupal_get_path('theme', 'lezoo'). '/js/myAngular.js', array('scope' => 'footer'));
	drupal_add_js('//cdnjs.cloudflare.com/ajax/libs/chosen/1.0/chosen.jquery.min.js', array('type' => 'external'));
	drupal_add_js('//cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js', array('type' => 'external'));
	drupal_add_js('//cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js', array('type' => 'external', 'scope' => 'footer'));
	drupal_add_js('//cdnjs.cloudflare.com/ajax/libs/jquery.isotope/1.5.25/jquery.isotope.min.js', array('type' => 'external', 'scope' => 'footer'));
	//Add instant click only for anon users
	// if($variables['user']->uid == 0)
	// {
	// 	drupal_add_js("InstantClick.on('change', function(){
	// 		Drupal.attachBehaviors();
	// 	});
	// 	InstantClick.init();", array('type' => 'inline', 'scope' => 'footer'));
	// }
	if(isset($variables['user']->roles['3']))
	{
		$variables['classes_array'][] = $variables['user']->roles['3'];
	}
	drupal_add_js(libraries_get_path('share42') . '/share42.js', array(
		'type' => 'file',
		'scope' => 'footer',
		'preprocess' => false,
		)
	);
}

/**
* @file
* menu-link.func.php
*/

/**
* Overrides theme_menu_link().
*/
function lezoo_menu_link(array $variables) {
	$element                           = $variables['element'];
	$element['#attributes']['class'][] = strtolower($element['#title']);
	return bootstrap_menu_link($variables);

}

/**
* @file
* bootstrap-search-form-wrapper.func.php
*/

/**
* Theme function implementation for bootstrap_search_form_wrapper.
*/
function lezoo_bootstrap_search_form_wrapper($variables) {
	$output = '<div class="input-group">';
	$output .= $variables['element']['#children'];
	$output .= '<span class="input-group-btn">';
	$output .= '<button type="submit" class="btn btn-default">';
// We can be sure that the font icons exist in CDN.
	if (theme_get_setting('bootstrap_cdn')) {
		$output .= _bootstrap_icon('search');
	}
	else {
		$output .= _bootstrap_icon('search');;
	}
	$output .= '</button>';
	$output .= '</span>';
	$output .= '</div>';
	return $output;
}



function lezoo_preprocess_page(&$variables) {
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
function lezoo_preprocess_node(&$variables) {
	$variables['title_attributes_array']['class'] = 'node-title';

	$variables['classes_array'][] = 'view-mode-' . $variables['view_mode'];
	$node_status = array(
		'open' => 'node-open',
		'closed' => 'node-closed'
		);
	drupal_add_js(array('lezoo_theme' => array('node_status' => $node_status)), 'setting');
	$variables['is_page'] = !empty($variables['is_page']) ? $variables['is_page'] : false;
	$variables['classes_array'][] = (!empty($variables['is_page']) && $variables['is_page']) ? $node_status['open']. " node-full-page" : $node_status['closed'] . ' node-in-list';
	$variables['left_col_classes'] = "col-left col-lg-5 col-md-4 col-sm-3 col-xs-12 pinned";
	$variables['right_col_classes'] = "col-right col-lg-7 col-md-8 col-sm-9 col-xs-12";
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
			if($variables['view_mode'] == 'full')
			{
//add related items to the views
				$section = $variables['field_section']['und']['0']['tid'];
				$genres = null;
				$tags = null;
				if(!empty($variables['field_music_genre']) && count($variables['field_music_genre']) != 0)
				{
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
				}
				if(!empty($variables['field_tags']))
				{
					foreach($variables['field_tags'] as $tag)
					{
						$tags .= $tag['tid'] . '+';
					}
					$genres  = empty($genres) ? null : $genres;
					$tags    = empty($tags) ? null : $tags;
					$related = views_embed_view('related', 'default', $variables['nid'], $section, $genres, $tags);
					
					if($related)
					{
						$related_block = "<aside class=\"related-posts\"><h3 class=\"block-title related-title\">". t('Encore plus') ."</h3>" . $related . "</aside>";
						$variables['related'] = $related_block;
					}
				}

			}
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

//share42
	global $base_url;
	$variables['share42'] = '<div class="share42init" data-url="' . $base_url .'/'. drupal_get_path_alias('node/' . $variables['nid']) . '" data-title="' . $variables['node']->title . '"></div>';
}

//set video frame width to 100%
function lezoo_video_filter_iframe(&$variables) {
	$video           = $variables['video'];
	$video['width']  = '100%';
	$video['height'] = '350';
	$classes         = video_filter_get_classes($video);
	$output          = '<iframe src="' . $video['source'] . '" width="' . $video['width'] . '" height="' . $video['height'] . '" class="video-filter ' . implode(' ', $classes) . '" frameborder="0"></iframe>';
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


function get_img_url($style, $field_name, $node){
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

function lezoo_preprocess_field(&$vars, $hook){
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

function lezoo_preprocess_media_soundcloud_audio(&$variables) {
	$variables['output'] = preg_replace('/visual=true/', '', $variables['output']);
}


function lezoo_block_view($delta = ''){
	$block = array();
	switch ($delta) {
		case 'webcal_lezoo':
		$block['subject'] = '';
		$block['content'] = _modal();
		break;
	}
	return $block;
}

function lezoo_header($title = 'group'){
	$title = t($title);
	return "<div class=\"clickable group-trigger visible-xs\">$title</div>";
}


function lezoo_soundcloud_filter_embed_html5($variables) {
	$variables['sound']['width'] = "99.5%";
	$variables['sound']['autoplay'] = false;
	return theme_soundcloud_filter_embed_html5($variables);
}