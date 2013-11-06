<?php 
// function lezoo_status_messages($display = NULL) {
//     $output = '';
//     global $user;
//     $is_admin = in_array('admin', $user->roles);
//     foreach (drupal_get_messages($display) as $type => $messages) {
//       if (($type == 'error' && $is_admin > 0) || $type != 'error') {
//         $output .= "<div class=\"messages $type\">\n";
//         if (count($messages) > 1) {
//           $output .= " <ul>\n";
//           foreach ($messages as $message) {
//             $output .= '  <li>'. $message ."</li>\n";
//           }
//           $output .= " </ul>\n";
//         }
//         else {
//           $output .= $messages[0];
//         }
//         $output .= "</div>\n";
//       }
//     }
//     return $output;
//   }
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
	else
	{
		 drupal_get_messages('warning');
		 drupal_get_messages('error');
	}


}

/**
 * Implements hook_preprocess().
 */
function lezoo_preprocess_node(&$variables) {
	$variables['theme_hook_suggestions'][] = 'node__' . $variables['type'] . '__' . $variables['view_mode'];
	if(!$variables['is_front'])
	{
		if($variables['type'] == 'event')
		{
			menu_set_active_item('events');
		}
		else if($variables['type'] == 'installations')
		{
			menu_set_active_item('visual');	
		}
		else if($variables['type'] == 'blog_post')// && $variables['field_section']['und']['0']['tid'] == 28)
{
	menu_set_active_item('podcasts');	
}
}
}

function lezoo_l($title, $url, $options = array()){
	$options['html'] = true;
	print l($title, $url, $options);
}


/**
 * Bootstrap theme wrapper function for the primary menu links.
 */
function lezoo_menu_tree__primary(&$variables) {
	return '<ul class="menu nav navbar-nav primary">' . $variables['tree'] . '</ul>';
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
		$field_array = array('field_artist_name', 'field_label','field_origin', 'field_link', 'field_artist_details');
		rows_from_field_collection($vars, $vars['element']['#field_name'], $field_array);
	}
}
