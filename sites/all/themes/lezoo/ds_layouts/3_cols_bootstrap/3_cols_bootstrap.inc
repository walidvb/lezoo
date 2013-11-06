<?php

/**
 * @file
 * Display Suite 3 cols bootstrap configuration.
 */

function ds_3_cols_bootstrap() {
  return array(
    'label' => t('3 cols bootstrap'),
    'regions' => array(
      'left' => t('Left'),
      'middle' => t('Middle'),
      'right' => t('Right'),
      'bottom' => t('Bottom'),
    ),
    // Uncomment if you want to include a CSS file for this layout (3_cols_bootstrap.css)
    //'css' => TRUE,
    // Uncomment if you want to include a preview for this layout (3_cols_bootstrap.png)
    // 'image' => TRUE,
  );
}
