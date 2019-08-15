<?php
/**
 * @file
 * social_fieldgroup.field_group.inc
 */

/**
 * Implements hook_field_group_info().
 */
function social_fieldgroup_field_group_info() {
  $export = array();

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_social|node|article|form';
  $field_group->group_name = 'group_social';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'article';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Social',
    'weight' => '2',
    'children' => array(
      0 => 'field_facebook',
      1 => 'field_twitter',
      2 => 'field_vimeo',
      3 => 'field_youtube',
      4 => 'field_homepage',
      5 => 'field_soundcloud',
    ),
    'format_type' => 'fieldset',
    'format_settings' => array(
      'formatter' => 'collapsible',
      'instance_settings' => array(
        'description' => '',
        'classes' => '',
      ),
    ),
  );
  $export['group_social|node|article|form'] = $field_group;

  return $export;
}
