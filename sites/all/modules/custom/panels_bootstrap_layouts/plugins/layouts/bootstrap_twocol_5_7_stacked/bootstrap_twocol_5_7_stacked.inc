<?php

/**
 * Implements hook_panels_layouts().
 */
// Plugin definition
$plugin = array(
  'title' => t('Two Columns, 40/60 Stacked'),
  'category' => t('Bootstrap'),
  'icon' => 'bootstrap_twocol_stacked.png',
  'theme' => 'bootstrap_twocol_7_5_stacked',
  'admin css' => '../panels-bootstrap-layouts-admin.css',
  'regions' => array(
    'top' => t('Top'),
    'left' => t('Left'),
    'right' => t('Right'),
    'bottom' => t('Bottom'),
  ),
);
