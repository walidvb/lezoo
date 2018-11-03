<?php
/**
 * @file
 * media_mixcloud/theme/media_mixcloud.theme.inc
 *
 * Contains an implementation of template_preprocess_media_mixcloud_audio.
 */

/**
 * Preprocessing the managed file before rendering.
 * @see template_preprocess_hook()
 */
function template_preprocess_media_mixcloud_audio(&$vars) {
  $wrapper = file_stream_wrapper_get_instance_by_uri($vars['uri']);
  $file = file_stream_wrapper_uri_normalize($vars['uri']);
  $fid = file_uri_to_object($file, TRUE)->fid;
  $parts = $wrapper->get_parameters();
  $media_mixcloud_url = '/' . implode('/', $parts);

  // Parameters for the request.
  $query_build = array(
    'query' => array(
      'url' => $media_mixcloud_url,
      'format' => 'json',
    ),
  );

  $oembed_url = url('http://www.mixcloud.com/oembed', $query_build);
  $response = drupal_http_request($oembed_url);

  // @todo: Investigate to make the player
  // more configurable in height and  width. This is okay for now.
  if ($response->code == 200) {
    $response_data = drupal_json_decode($response->data);
    $vars['output'] = $response_data['html'];
    $vars['fid'] = $fid;
  }
  else {
    $vars['output'] = '';
    watchdog('media_mixcloud', 'Failed to get a response upon rendering.');
  }
}
