<?php
/**
 * @file
 * Drupal needs this blank file.
 */

/**
 * Implements hook_field_formatter_info().
 */
function lezoo_field_formatter_info() {
  $info['date_format'] = array(
    'label' => t('date as <fri> <23>'),
    'field types' => array('date', 'datestamp', 'datetime'),
    'settings' => array(
      'format' => 'day_date',
      ),
    );

  return $info;
}

/**
 * Implements hook_field_formatter_settings_form().
 */
function lezoo_field_formatter_settings_form($field, $instance, $view_mode, $form, &$form_state) {
  //This gets the view_mode where our settings are stored
  $display = $instance['display'][$view_mode];
  //This gets the actual settings
  $settings = $display['settings'];
  //Initialize the element variable
  $element = array();
  //Add your select box
  $element['format'] = array(
    '#type'           => 'select',                           // Use a select box widget
    '#title'          => t('Format'),                   // Widget label
    '#description'    => t('Select the date format'), // Helper text
    '#default_value'  => $settings['day_date'],              // Get the value if it's already been set
    '#options'        => _lezoo_get_date_formats(),
    );
  return $element;
}

function _lezoo_get_date_formats(){
  return array(
    'day_date'  => 'ven 15',
    'day_date_month' => 'ven 15 oct',
    'date_month' => '15 oct',
    );
}
/**
 * Implements hook_field_formatter_settings_summary().
 */
function lezoo_field_formatter_settings_summary($field, $instance, $view_mode) {
  $display = $instance['display'][$view_mode];
  $settings = $display['settings'];

  $summary = t('Displays the date as @format', array('@format' => $settings['format']));
  return $summary;
}

/**
 * Implements hook_field_formatter_view().
 */

function lezoo_field_formatter_view($entity_type, $entity, $field, $instance, $langcode, $items, $display) {
  $settings = $display['settings']; // get the settings
  foreach($items as $index => $date)
  {
    $element[$index]['#type'] = 'markup';

    $date_rendered = lezoo_render_date($date['value'], $settings['format']);
      $element[$index]['#markup'] = $date_rendered; // Assign it to the #markup of the element
    }
    $element['#prefix'] = '<div class="date lezoo-date">';
    $element['#suffix'] = '</div>';
    return $element;
  }


function lezoo_token_info(){
  $types['lezoo'] = array(
    'name' => t('leZoo custom tokens'),
    'description' => t('Custom tokens for leZoo'),
    );

  $tokens['lezoo']['day_date'] = array(
      'name' => t('Date with day_date'),
      'description' => t('The node\'s date with day_date')
    );
  $tokens['lezoo']['day_date_month'] = array(
      'name' => t('Date with day_date_month'),
      'description' => t('The node\'s date with day_date_month')
    );
  $tokens['lezoo']['date_month'] = array(
      'name' => t('Date with date month'),
      'description' => t('The node\'s date with date month')
    );

  return array(
    'types' => $types,
    'tokens' => $tokens
    );
}

function lezoo_tokens($type, $tokens, array $data = array(), array $options = array()) {
  $replacements = array();

  if($type == 'lezoo')
  {
    foreach($tokens as $name => $original)
    {
      $format = $name;
      $date = $data['node']->field_date['und'][0]['value'];
      dpm($date);
      $render = lezoo_render_date($date, $format);
      dpm($render);
      $replacements[$original] = $render;
    }
  }
  return $replacements;
}

//the function rendering a link as an icon.
function lezoo_render_date($date_orig, $format)
{
  setlocale(LC_ALL, 'fr_FR.UTF-8');

  $output = '';
  $date_orig = strtotime($date_orig);  
  $day = strftime('%a', $date_orig);
  $date = strftime('%d', $date_orig);
  $month = strftime('%b', $date_orig);

  switch($format)
  {
    case 'day_date_month':

    return "<span class=\"day\">$day</span>\n<span class=\"date-number\">$date</span>\n<span class=\"month\">$month</span>";
    break;
    case 'day_date':
    return "<span class=\"day\">$day</span>\n<span class=\"date-number\">$date</span>\n";
    break;
    case 'date_month':
    return "<span class=\"date-number\">$date</span>\n<span class=\"month\">$month</span>";
    break;

  }
  return $output;
}













