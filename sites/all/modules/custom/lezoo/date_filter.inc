<?php 
// /**
//  * Implements hook_form_FORM_ID_alter(); alter views_exposed_form.
//  */

function lezoo_views_query_alter(&$view, &$query) {
  //If a date was selected in the exposed filter, ignore the default date filter '> today'
	if($view->name == 'teaser_list')
	{
  $conditions = $view->query->where['1']['conditions'];
  $date_index = 3;
  if(isset($view->query->where['1']['conditions'][$date_index]) &&
    //if a date exposed filter was set
   $view->query->where['1']['conditions'][$date_index]['field'] != 'node.nid')
  {
    unset($view->query->where['1']['conditions'][2]);
  }
}
} 
