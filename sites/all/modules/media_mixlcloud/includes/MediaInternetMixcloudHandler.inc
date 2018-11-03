<?php
/**
 * @file
 * InternetHandler for Mixcloud
 */

class MediaInternetMixcloudHandler extends MediaInternetBaseHandler {

  /**
   * Double check that the url passed in is valid.
   */
  static public function validId($url) {
    $url = 'http://www.mixcloud.com/oembed/?url=' . $url;
    $response = drupal_http_request($url, array('method' => 'HEAD'));
    if ($response->code != 200) {
      return FALSE;
    }

    return TRUE;
  }

  /**
   * Parsing the embed code to check that it is valid.
   */
  public function parse($embed_code) {
    $patterns = array(
      '@mixcloud\.com(\/?[^"\&]+)@i',
    );
    foreach ($patterns as $pattern) {
      preg_match($pattern, $embed_code, $matches);
      if (count($matches[1]) > 0 && self::validId($matches[1])) {
        // Get parts of the embed code and build a valid file URL
        // @see _parse_url()
        $parts = explode('/', $matches[1]);
        return file_stream_wrapper_uri_normalize('mixcloud://artist/' . $parts[1] . '/track/' . $parts[2]);
      }
    }
  }

  /**
   * Returns true if the parse went well.
   */
  public function claim($embed_code) {
    if ($this->parse($embed_code)) {
      return TRUE;
    }
  }

  /**
   * Fetches the information about the media and returns the embed data.
   */
  public function getOEmbed() {
    $oembed_url = url('http://www.mixcloud.com/oembed', array(
      'query' => array(
        'url' => $this->embedCode,
        'format' => 'json')));

    $res = drupal_http_request($oembed_url);
    if (!isset($res->error)) {
      return drupal_json_decode($res->data);
    }
  }

  /**
   * Returns the file object.
   */
  public function getFileObject() {
    $uri = $this->parse($this->embedCode);
    $file = file_uri_to_object($uri, TRUE);
    if (empty($file->fid) && $info = $this->getOEmbed()) {
      $file->filename = $info['title'];
    }

    return $file;
  }
}
