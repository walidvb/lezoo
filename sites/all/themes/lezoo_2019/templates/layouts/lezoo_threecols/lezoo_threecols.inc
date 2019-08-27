<?php

/**
 * Implements hook_panels_layouts().
 */
// Plugin definition
$plugin = array(
  'title' => t('Le Zoo three cols stacked'),
  'category' => t('lezoo'),
  'icon' => 'bootstrap_threecol_stacked.png',
  'theme' => 'lezoo_threecols',
  'admin css' => './lezoo_threecols_admin.css',
  'regions' => array(
    'left' => t('Left'),
    'center' => t('Center'),
    'right' => t('Right'),
  ),
);
