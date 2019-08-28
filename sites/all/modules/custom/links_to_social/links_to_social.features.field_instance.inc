<?php
/**
 * @file
 * links_to_social.features.field_instance.inc
 */

/**
 * Implements hook_field_default_field_instances().
 */
function links_to_social_field_default_field_instances() {
  $field_instances = array();

  // Exported field_instance: 'node-artist-field_social'
  $field_instances['node-artist-field_social'] = array(
    'bundle' => 'artist',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => 'Links to social platforms. Supported platforms are: home, soundcloud, twitter, youtube, vimeo. 
Please insert using format: title=soundcloud, link=http://soundcloud.com/foobar',
    'display' => array(
      'default' => array(
        'label' => 'hidden',
        'module' => 'link',
        'settings' => array(),
        'type' => 'link_default',
        'weight' => 1,
      ),
      'teaser' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
    ),
    'entity_type' => 'node',
    'field_name' => 'field_social',
    'label' => 'Social',
    'required' => 0,
    'settings' => array(
      'attributes' => array(
        'class' => '',
        'configurable_title' => 0,
        'rel' => 'nofollow',
        'target' => '_blank',
        'title' => '',
      ),
      'display' => array(
        'url_cutoff' => 80,
      ),
      'enable_tokens' => 1,
      'rel_remove' => 'default',
      'title' => 'required',
      'title_maxlength' => 128,
      'title_value' => '',
      'url' => 0,
      'user_register_form' => FALSE,
      'validate_url' => 1,
    ),
    'widget' => array(
      'active' => 0,
      'module' => 'link',
      'settings' => array(),
      'type' => 'link_field',
      'weight' => 3,
    ),
  );

  // Translatables
  // Included for use with string extractors like potx.
  t('Links to social platforms. Supported platforms are: home, soundcloud, twitter, youtube, vimeo. 
Please insert using format: title=soundcloud, link=http://soundcloud.com/foobar');
  t('Social');

  return $field_instances;
}
