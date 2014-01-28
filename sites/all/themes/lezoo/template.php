<?php 


/**
 * @file template.php
 */
function lezoo_preprocess_html(&$variables) {
	drupal_add_css('//cdnjs.cloudflare.com/ajax/libs/animate.css/2.0/animate.min.css', array('type' => 'external'));
	drupal_add_js('//netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js', array('type' => 'external'));
	drupal_add_js('//cdnjs.cloudflare.com/ajax/libs/angular.js/1.1.1/angular.min.js', array('type' => 'external', 'scope' => 'footer'));
	drupal_add_js(drupal_get_path('theme', 'lezoo'). '/js/myAngular.js', array('scope' => 'footer'));
	drupal_add_js('//cdnjs.cloudflare.com/ajax/libs/chosen/1.0/chosen.jquery.min.js', array('type' => 'external'));
	drupal_add_js('//cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js', array('type' => 'external', 'scope' => 'footer'));
	drupal_add_js('//cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js', array('type' => 'external', 'scope' => 'footer'));
	drupal_add_js('//cdnjs.cloudflare.com/ajax/libs/jquery.isotope/1.5.25/jquery.isotope.min.js', array('type' => 'external', 'scope' => 'footer'));
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
	$element = $variables['element'];
	$sub_menu = '';
	$element['#attributes']['class'][] = strtolower($element['#title']);
  //change behavior for visu
	if($element['#original_link']['mlid'] == '1266')
	{

  	  // On primary navigation menu, class 'active' is not set on active menu item.
	  // @see https://drupal.org/node/1896674
		$current_page = explode('/', $_GET['q']);
		if (($element['#href'] == $current_page[0] || ($element['#href'] == '<front>' && drupal_is_front_page())) && (empty($element['#localized_options']['language']))) {
			$element['#attributes']['class'][] = 'active';
		}
		$output = l($element['#title'], $element['#href'], $element['#localized_options']);
		unset($element['#below']['#theme_wrappers']);
		unset($element['#below']['#sorted']);
		$sub_menu .= '<ul class="sub-menu">';
		foreach($element['#below'] as $child)
		{
			$sub_menu .= render($child);
		}
		$sub_menu .= '</ul>';
		return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";;
	}
  else //return bootstrap_menu_link().
  {
  	return bootstrap_menu_link($variables);
  }
}


function lezoo_preprocess_page(&$variables) {
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
			dpm($variables['node']->field_section['und']['0']['tid']);
			switch($variables['node']->field_section['und']['0']['tid'])
			{
				case 28:
				$menu_active_item ='podcasts';
				break;
				case 27:
				$menu_active_item ='visu';
				break;
			}
			break;
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
	$variables['submitted'] = '<span class="user">'. $variables['user']->name . '</span><span class="timestamp">' . strftime('%d/%m/%Y', $variables['created']) . '</span>';
	if(!$variables['is_front'])
	{
		if($variables['type'] == 'event')
		{
			$variables['ics'] = '<div class="ics-container">' . l('Ajouter au calendrier', base_path() . 'events/'. $variables['nid'] . '/' . $variables['title'] . '.ics', array('attributes' => array('class' => 'event-ics'))) . '</div>';
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
					$genres = empty($genres) ? null : $genres;
					$tags = empty($tags) ? null : $tags;
					$related = views_embed_view('related', 'default', $variables['nid'], $section, $genres, $tags);

					$related_block = "<aside class=\"related-posts\"><h3 class=\"block-title related-title\">". t('Encore plus') ."</h3>" . $related . "</aside>";
					$variables['related'] = $related_block;
				}

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

	//share42
	global $base_url;
	$variables['share42'] = '<div class="share42init" data-url="' . $base_url .'/'. drupal_get_path_alias('node/' . $variables['nid']) . '" data-title="' . $variables['node']->title . '"></div>';
}

//set video frame width to 100%
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


function get_img_url($style, $field_name, $node){
	$field = $node->$field_name;
	$file = file_load($field['und'][0]['fid']);
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
	if ($vars['element']['#field_name'] == 'field_artist' || $vars['element']['#field_name'] =='field_vjs') {
		$vars['theme_hook_suggestions'][] = 'field__artist_collection';
		$vars['theme_hook_suggestions'][] = 'field__artist_collection__';
		$vars['teaser'] = $vars['element']['#view_mode'] == 'teaser';
		$vars['view_mode'] = $vars['element']['#view_mode'];
		$field_array = array('field_artist_name', 'field_label','field_origin', 'field_link', 'field_artist_details');
		rows_from_field_collection($vars, $vars['element']['#field_name'], $field_array);

	}
}

function lezoo_block_info(){
	$blocks = array();
	$blocks['webcal_lezoo'] = array(
		'info' => t('Webcal: The modal dialog to subsribe to the agenda'),
		'cache' => DRUPAL_NO_CACHE,
		);
	return $blocks;
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

function _modal(){
	$output = '
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" data-backdrop="true" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Choisis ton style!</h4>
					</div>
					<div class="modal-body">
						<div ng-app="leZooApp">
							<div ng-controller="feedFilter">
								<form>
									<span ng-repeat="genre in genres" class="genre" ng-class="{\'selected\': genre.selected}" ng-click="genre.selected = !genre.selected"> 
										{{genre.name}}
									</span>
								</form>
								<a ng-href="webcal://lezoo.ch/{{params()}}feed.ics" class="btn btn-primary btn-lg">Synchronise ton agenda avec celui du ZOO!</a>
							</div>
						</div>
					</div>
					<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fermerasd</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->';
	return $output;
}
