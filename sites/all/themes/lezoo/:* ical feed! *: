/* ical feed! */

$view = new view();
$view->name = 'feed';
$view->description = '';
$view->tag = 'default';
$view->base_table = 'node';
$view->human_name = 'Feed';
$view->core = 7;
$view->api_version = '3.0';
$view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

/* Display: Master */
$handler = $view->new_display('default', 'Master', 'default');
$handler->display->display_options['use_more_always'] = FALSE;
$handler->display->display_options['access']['type'] = 'perm';
$handler->display->display_options['cache']['type'] = 'none';
$handler->display->display_options['query']['type'] = 'views_query';
$handler->display->display_options['exposed_form']['type'] = 'basic';
$handler->display->display_options['pager']['type'] = 'full';
$handler->display->display_options['style_plugin'] = 'grid';
$handler->display->display_options['row_plugin'] = 'fields';
/* Field: Content: Date */
$handler->display->display_options['fields']['field_date']['id'] = 'field_date';
$handler->display->display_options['fields']['field_date']['table'] = 'field_data_field_date';
$handler->display->display_options['fields']['field_date']['field'] = 'field_date';
$handler->display->display_options['fields']['field_date']['label'] = '';
$handler->display->display_options['fields']['field_date']['element_type'] = '0';
$handler->display->display_options['fields']['field_date']['element_label_colon'] = FALSE;
$handler->display->display_options['fields']['field_date']['element_wrapper_type'] = '0';
$handler->display->display_options['fields']['field_date']['element_default_classes'] = FALSE;
$handler->display->display_options['fields']['field_date']['settings'] = array(
  'format_type' => 'long',
  'fromto' => 'both',
  'multiple_number' => '',
  'multiple_from' => '',
  'multiple_to' => '',
);
$handler->display->display_options['fields']['field_date']['field_api_classes'] = TRUE;
/* Field: Content: Genre */
$handler->display->display_options['fields']['field_music_genre']['id'] = 'field_music_genre';
$handler->display->display_options['fields']['field_music_genre']['table'] = 'field_data_field_music_genre';
$handler->display->display_options['fields']['field_music_genre']['field'] = 'field_music_genre';
$handler->display->display_options['fields']['field_music_genre']['label'] = '';
$handler->display->display_options['fields']['field_music_genre']['element_type'] = '0';
$handler->display->display_options['fields']['field_music_genre']['element_label_colon'] = FALSE;
$handler->display->display_options['fields']['field_music_genre']['element_wrapper_type'] = '0';
$handler->display->display_options['fields']['field_music_genre']['element_default_classes'] = FALSE;
$handler->display->display_options['fields']['field_music_genre']['delta_offset'] = '0';
$handler->display->display_options['fields']['field_music_genre']['field_api_classes'] = TRUE;
/* Field: Content: Title */
$handler->display->display_options['fields']['title']['id'] = 'title';
$handler->display->display_options['fields']['title']['table'] = 'node';
$handler->display->display_options['fields']['title']['field'] = 'title';
$handler->display->display_options['fields']['title']['label'] = '';
$handler->display->display_options['fields']['title']['alter']['alter_text'] = TRUE;
$handler->display->display_options['fields']['title']['alter']['text'] = '[title] [ [field_music_genre] ]';
$handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
$handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
$handler->display->display_options['fields']['title']['element_label_colon'] = FALSE;
/* Field: Content: Artist */
$handler->display->display_options['fields']['field_artist']['id'] = 'field_artist';
$handler->display->display_options['fields']['field_artist']['table'] = 'field_data_field_artist';
$handler->display->display_options['fields']['field_artist']['field'] = 'field_artist';
$handler->display->display_options['fields']['field_artist']['label'] = '';
$handler->display->display_options['fields']['field_artist']['element_type'] = '0';
$handler->display->display_options['fields']['field_artist']['element_label_colon'] = FALSE;
$handler->display->display_options['fields']['field_artist']['element_wrapper_type'] = '0';
$handler->display->display_options['fields']['field_artist']['element_default_classes'] = FALSE;
$handler->display->display_options['fields']['field_artist']['settings'] = array(
  'view_mode' => 'full',
);
$handler->display->display_options['fields']['field_artist']['delta_offset'] = '0';
$handler->display->display_options['fields']['field_artist']['field_api_classes'] = TRUE;
/* Field: Content: Vjs */
$handler->display->display_options['fields']['field_vjs']['id'] = 'field_vjs';
$handler->display->display_options['fields']['field_vjs']['table'] = 'field_data_field_vjs';
$handler->display->display_options['fields']['field_vjs']['field'] = 'field_vjs';
$handler->display->display_options['fields']['field_vjs']['label'] = '';
$handler->display->display_options['fields']['field_vjs']['alter']['alter_text'] = TRUE;
$handler->display->display_options['fields']['field_vjs']['alter']['text'] = '[field_artist]
[field_vjs]';
$handler->display->display_options['fields']['field_vjs']['element_type'] = '0';
$handler->display->display_options['fields']['field_vjs']['element_label_colon'] = FALSE;
$handler->display->display_options['fields']['field_vjs']['element_wrapper_type'] = '0';
$handler->display->display_options['fields']['field_vjs']['element_default_classes'] = FALSE;
$handler->display->display_options['fields']['field_vjs']['settings'] = array(
  'view_mode' => 'full',
);
$handler->display->display_options['fields']['field_vjs']['delta_offset'] = '0';
$handler->display->display_options['fields']['field_vjs']['field_api_classes'] = TRUE;
/* Sort criterion: Content: Post date */
$handler->display->display_options['sorts']['created']['id'] = 'created';
$handler->display->display_options['sorts']['created']['table'] = 'node';
$handler->display->display_options['sorts']['created']['field'] = 'created';
$handler->display->display_options['sorts']['created']['order'] = 'DESC';
/* Contextual filter: Content: Nid */
$handler->display->display_options['arguments']['nid']['id'] = 'nid';
$handler->display->display_options['arguments']['nid']['table'] = 'node';
$handler->display->display_options['arguments']['nid']['field'] = 'nid';
$handler->display->display_options['arguments']['nid']['default_argument_type'] = 'fixed';
$handler->display->display_options['arguments']['nid']['summary']['number_of_records'] = '0';
$handler->display->display_options['arguments']['nid']['summary']['format'] = 'default_summary';
$handler->display->display_options['arguments']['nid']['summary_options']['items_per_page'] = '25';
/* Filter criterion: Content: Published */
$handler->display->display_options['filters']['status']['id'] = 'status';
$handler->display->display_options['filters']['status']['table'] = 'node';
$handler->display->display_options['filters']['status']['field'] = 'status';
$handler->display->display_options['filters']['status']['value'] = 1;
$handler->display->display_options['filters']['status']['group'] = 1;
$handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
/* Filter criterion: Content: Type */
$handler->display->display_options['filters']['type']['id'] = 'type';
$handler->display->display_options['filters']['type']['table'] = 'node';
$handler->display->display_options['filters']['type']['field'] = 'type';
$handler->display->display_options['filters']['type']['value'] = array(
  'event' => 'event',
);

/* Display: Page */
$handler = $view->new_display('page', 'Page', 'page_1');
$handler->display->display_options['path'] = 'calendar';

/* Display: Feed */
$handler = $view->new_display('feed', 'Feed', 'feed_1');
$handler->display->display_options['pager']['type'] = 'some';
$handler->display->display_options['style_plugin'] = 'date_ical';
$handler->display->display_options['style_options']['cal_name'] = 'lezoo';
$handler->display->display_options['row_plugin'] = 'date_ical_fields';
$handler->display->display_options['row_options']['date_field'] = 'field_date';
$handler->display->display_options['row_options']['title_field'] = 'title';
$handler->display->display_options['row_options']['description_field'] = 'field_vjs';
$handler->display->display_options['row_options']['additional_settings'] = array(
  'skip_blank_dates' => 0,
);
$handler->display->display_options['path'] = 'feed.ics';
$translatables['feed'] = array(
  t('Master'),
  t('more'),
  t('Apply'),
  t('Reset'),
  t('Sort by'),
  t('Asc'),
  t('Desc'),
  t('Items per page'),
  t('- All -'),
  t('Offset'),
  t('« first'),
  t('‹ previous'),
  t('next ›'),
  t('last »'),
  t('[title] [ [field_music_genre] ]'),
  t('[field_artist]
[field_vjs]'),
  t('All'),
  t('Page'),
  t('Feed'),
);
