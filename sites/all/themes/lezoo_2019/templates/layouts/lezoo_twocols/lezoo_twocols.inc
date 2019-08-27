<?php

/**
 * Implements hook_panels_layouts().
 */
// Plugin definition
$plugin = array(
  'title' => t('Le Zoo two cols stacked'),
  'category' => t('lezoo'),
  'icon' => 'bootstrap_twocol_stacked.png',
  'theme' => 'lezoo_twocols',
  'admin css' => '../panels-bootstrap-layouts-admin.css',
  'regions' => array(
    'top' => t('Top'),
    'top_left' => t('Top Left'),
    'top_right' => t('Top Right'),
    'center' => t('Center'),
    'bottom_left' => t('Bottom Left'),
    'bottom_right' => t('Bottom Right'),
    'bottom' => t('Bottom'),
  ),
);
