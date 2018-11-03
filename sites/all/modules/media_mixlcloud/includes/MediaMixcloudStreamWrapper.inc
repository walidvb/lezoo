<?php

/**
 * @file
 * Contiains MediaMixcloudStreamWrapper.
 */

/**
 * Implementation of MediaReadOnlyStreamWrapper.
 * @todo: Investigate saving thumbnail
 * and/or normal images to the player
 */
class MediaMixcloudStreamWrapper extends MediaReadOnlyStreamWrapper {
  protected $base = 'http://www.mixcloud.com/oembed/';
  /**
   * Returning the mimetype.
   */
  static function getMimeType($uri, $mapping = NULL) {
    return 'audio/mixcloud';
  }

  function interpolateUrl() {
    if ($parameters = $this->get_parameters()) {
      $query = array(
        'url' => '/' . implode('/', $parameters),
      );
      return $this->base . '?' . http_build_query($query);
    }
  }
}
