<?php 

/**
 * Implements hook_menu().
 */
function lezoo_menu() {
  /*
   *$items['blog'] = array(
   *  'title' => 'blogs',
   *  'page callback' => 'blog_page',
   *  'access arguments' => array('access content'),
   *  'type' => MENU_SUGGESTED_ITEM,
   *);
   */
  $items['json/genres'] = array(
    'page callback' => '_lezoo_get_genres',
    'access arguments' => array('access content'),
    'type' => MENU_CALLBACK,
  );

  return $items;
}

function _lezoo_get_genres()
{
	$result;
	$result = taxonomy_get_tree(2, 0, 1);
	return drupal_json_output(array('genres' => $result));
}