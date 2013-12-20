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



/**
 * @file
 * Token module integration.
 */

function lezoo_token_info(){
  $formats = _lezoo_get_date_formats();
  $date_formats = array();
  foreach($formats as $format => $desc)
  {
    $date_formats[$format] = array(
      'name' => $format,
      'desc' => t('date as @f', array("@f" =>  $desc)),
      );
  }

  $info['types']['lezoo-date'] = array(
      'name' => t('leZoo Date'),
      'description' => t('The field_date of the node'),
      'needs-data' => 'date-field-value',
      'field-value' => TRUE,
    );

  $info['tokens']['lezoo-date'] = array(
    'lezoo-date' => $date_formats,
    );

  return $info; 

}

/**
 * Implementation of hook_token_info_alter().
 */
function lezoo_token_info_alter(&$data) {
  dpm($data, '$data');
  $fields = field_info_fields();
  dpm($fields,'$fields');
  foreach ($fields as $field) {
    if ($field['type'] == 'datetime') {
      foreach ($field['bundles'] as $entity_type => $bundles) {
        $token_type = token_get_entity_mapping('entity', $entity_type);
        if (!empty($data['tokens'][$token_type][$field['field_name']])) {
          $data['tokens'][$token_type][$field['field_name']]['type'] = 'lezoo-date';
        }
      }
    }
  }
}

function lezoo_tokens($type, $tokens, array $data = array(), array $options = array()) {
  $replacements = array();
  $language_code = isset($options['language']) ? $options['language']->language : NULL;

  if (($type == 'lezoo-date') && !empty($data['item'])) {
    $item = $data['item'];

    // Create tokens for the field "Date" or "Start date".
    if (($date_tokens = token_find_with_prefix($tokens, 'lezoo')) && !empty($item['value'])) {
      // Load the Start date and convert to a unix timestamp.
      $date = new DateObject($item['value'], $item['timezone_db'], date_type_format($item['date_type']));
      if (!empty($date) && $item['timezone_db'] != $item['timezone']) {
        date_timezone_set($date, timezone_open($item['timezone']));
      }
      $timestamp = !empty($date) ? date_format_date($date, 'custom', 'U') : '';
      // Generate the token replacements, using the date token type provided
      // by system.module.
      $replacements += token_generate('date', $date_tokens, array('date' => $timestamp), $options);
    }

    return $replacements;
  }
}
//datetime


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













