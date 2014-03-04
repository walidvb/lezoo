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
    'label' => t('leZOO custom date formats'),
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
    'date_month' => 'oct 15',
    'day_month_year'  => 'october 2012',
    'date_year' => '15 oct 2012',
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
    $tokens['lezoo']['day_year'] = array(
      'name' => t('Date with day_year'),
      'description' => t('The node\'s date with 23 jan 2012')
      );
    $tokens['lezoo']['day_month_year'] = array(
      'name' => t('Date with day_month_year'),
      'description' => t('The node\'s date as january 2012')
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
        $render = lezoo_render_date($date, $format);
        $replacements[$original] = $render;
      }
    }
    return $replacements;
  }

//the function rendering a link as an icon.
  function lezoo_render_date($date_original, $format)
  {
    setlocale(LC_ALL, 'fr_FR.UTF-8');

    $output = '';
    $date_original = strtotime($date_original);  

    $day = strftime('%a', $date_original);
    $date = strftime('%d', $date_original);
    $month = strftime('%b', $date_original);
    $month_full = strftime('%B', $date_original);
    $year = strftime('%Y', $date_original);
    
    $day = mb_substr($day, 0, 3);
    $date = mb_substr($date, 0, 3);
    $month = mb_substr($month, 0, 3);
    $month_full = mb_substr($month_full, 0, 3);

   

    // $day = date('D', $date_original);
    // $date = date('d', $date_original);
    // $month = date('M', $date_original);
    // $month_full = date('F', $date_original);
    // $year = date('Y', $date_original);
    
    switch($format)
    {
      case 'day_date_month':

      $output =  "<span class=\"day\">$day</span>\n<span class=\"date-number\">$date</span>\n<span class=\"month\">$month</span>";
      break;
      case 'day_date':
      $output =  "<span class=\"day\">$day</span>\n<span class=\"date-number\">$date</span>\n";
      break;
      case 'date_month':
      $output =  "<span class=\"month\">$month</span>\n<span class=\"date-number\">$date</span>";
      break;
      case 'day_year':
      $output =  "<span class=\"day\">$day</span>\n<span class=\"date-number\">$date</span>\n<span class=\"month\">$month</span><span class=\"date-year\">$year</span>";
      break;
      case 'day_month_year':
      $output =  "<span class=\"month\">$month_full</span><span class=\"date-year\">$year</span>";
      default: 
      $output =  "<span class=\"day\">$day</span>\n<span class=\"date-number\">$date</span>\n<span class=\"month\">$month</span><span class=\"date-year\">$year</span>";
    }
    return $output;
  }













