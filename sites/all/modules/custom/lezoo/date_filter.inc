<?php 
/**
 * Implements hook_form_FORM_ID_alter(); alter views_exposed_form.
 */

function lezoo_form_views_exposed_form_alter(&$form, &$form_state) {
  if($form['#id'] == 'views-exposed-form-teaser-list-panel-pane-1')
  {
   $form['#validate'][] = 'lezoo_views_exposed_form_validate';
    dpm('form_alter');
  }
}

function lezoo_views_exposed_form_validate(&$form, &$form_state) {

  $handlers = &$form_state['input'];
  foreach ($handlers as $key => $handler) {
    if (
      isset($form[$key]['value']['#type'])
      && $form[$key]['value']['#type'] == 'date_select'
      && $form[$key]['value']['#date_format'] == 'Y-m'
      && $form_state['input'][$key]['value']['month'] == '') {
      $form[$key]['value']['#date_format'] == 'Y';
    unset($form[$key]['value']['#granularity'][1]);
    $form[$key]['value']['#date_format'] = 'Y';
    unset($form_state['input'][$key]['value']['month']);
    unset($form_state['input'][$key]['value']['month']);
  }
}
    dpm('form validation');
    dpm($form);
    dpm('form_state');
    dpm($form_state);
}


function lezoo_views_query_alter(&$view, &$query) {
  //If a date was selected in the exposed filter, ignore the default date filter '> today'
  $conditions = $view->query->where['1']['conditions'];
  $date_index = 3;
  if(isset($view->query->where['1']['conditions'][$date_index]) &&
    //if a date exposed filter was set
   $view->query->where['1']['conditions'][$date_index]['field'] != 'node.nid')
  {
    unset($view->query->where['1']['conditions'][2]);
  }
  dpm($view);
} 

function lezoo_views_pre_view(&$view){
  dpm('pre-view');

}

function lezoo_views_pre_build(&$view){
  dpm('pre-build');

}

function lezoo_views_post_build(&$view){
  dpm('post_build');
  unset($view->exposed_input['date']['value']['month']);

}