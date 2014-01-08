<?php


define('PATH_LEZOO_FILES', '/home/flyer/');


class FeedsleZooEventsProcessor extends FeedsProcessor {

  /**
   * Define entity type.
   */
  public function entityType() {
    return 'event';
  }

  /**
   * Implements parent::entityInfo().
   */
  protected function entityInfo() {
    $info = parent::entityInfo();
    $info['label plural'] = t('leZoo events');
    return $info;
  }

  /**
   * Creates a new resource in memory and returns it.
   */
  protected function newEntity(FeedsSource $source) {
    $resource = entity_get_controller('event')->create();
    return $resource;
  }

  /**
   * Loads an existing resource.
   */
  protected function entityLoad(FeedsSource $source, $rid) {
    return shelter_resource_load($rid);
  }

  /**
   * Validates a resource.
   */
  protected function entityValidate($resource) {
    if (empty($resource->title)) {
      throw new FeedsValidationException(t('Unable to create resource with empty title.'));
    }
  }

  /**
   * Save a resource.
   */
  public function entitySave($resource) {
    $resource->type = 'event';
    shelter_resource_save($resource);
  }

  /**
   * Override setTargetElement to operate on a target item that is a resource.
   */
  public function setTargetElement(FeedsSource $source, $target_resource, $target_element, $value) {

    switch ($target_element) {

      case 'guid':
        $target_resource->feeds_item->guid = $value;
        break;


      // try to extract date from multiple formats
      case 'date':
        $saved_value = $value;
        $validated = FALSE;
        if (preg_match('/\d{4}/', $value)) {
          $validated = TRUE;
        }
        if (preg_match('/(\d{2})[-\/\s]+(\d{4})/', $value, $matches)) {
          $value = $matches[1] . $matches[2];
          $validated = TRUE;
        }
        if (preg_match('/(\d{2})[-\/\s]+(\d{2})[-\/\s]+(\d{4})/', $value, $matches)) {
          $value = mktime(0, 0, 0, $matches[2], $matches[1], $matches[3]);
          $validated = TRUE;
        }
        if ($validated) {
          $target_resource->$target_element = $value;
        }
        elseif (!empty($value)) {
          throw new FeedsValidationException(t('Date "@date" format is not valid.', array('@date' => $value)));
        }
        break;


      case 'multiple_publishers':
        $exploded = array_filter(explode('|', $value));
        foreach ($exploded as $publisher) {
          $publisher = trim($publisher);
          $terms = taxonomy_get_term_by_name($publisher, 'publisher');
          $found = FALSE;
          foreach ($terms as $term) {
            if ($term->name == $publisher) {
              $target_resource->field_publisher[LANGUAGE_NONE][] = array('tid' => $term->tid);
              $found = TRUE;
              break;
            }
          }
          if (!$found) {
            throw new FeedsValidationException(t('"@publisher" not found in publisher.', array('@publisher' => $publisher)));
          }
        }
        break;


      case 'multiple_locations':
        $exploded = array_filter(explode('|', $value));
        foreach ($exploded as $location) {
          $location = trim($location);
          $terms = taxonomy_get_term_by_name($location, 'location');
          $found = FALSE;
          foreach ($terms as $term) {
            if ($term->name == $location) {
              $target_resource->field_location[LANGUAGE_NONE][] = array('tid' => $term->tid);
              $found = TRUE;
              break;
            }
          }
          if (!$found) {
            throw new FeedsValidationException(t('"@location" not found in location.', array('@location' => $location)));
          }
        }
        break;


      // Taxonomy 'type' is hierarchical so we have to look for the parent name
      // before saving the term.
      case 'type_parent':
        $target_resource->tmp['type_parent'] = $value;
        break;
      case 'type_term':
        $type_parent = $target_resource->tmp['type_parent'];
        $terms = taxonomy_get_term_by_name($value, 'type');
        $found = FALSE;
        foreach ($terms as $term) {
          $parents = taxonomy_get_parents($term->tid);
          foreach ($parents as $parent) {
            if ($parent->name == $type_parent) {
              $found = TRUE;
              break;
            }
          }
          if ($found) {
            break;
          }
        }
        if ($found) {
          $target_resource->field_type[LANGUAGE_NONE][0]['tid'] = $term->tid;
        }
        else {
          throw new FeedsValidationException(t('"@parent"/"@term" combination could not be validated.', array('@term' => $value, '@parent' => $type_parent)));
        }
        break;



      // sector 1 & sector 2
      case 'sector1':
        $target_resource->tmp['sector1'] = $value;
        break;
      case 'sector2':
        $values = array($target_resource->tmp['sector1'], $value);
        $terms = array();
        foreach ($values as $value) {
          $term = taxonomy_get_term_by_name($value, 'cluster');
          if ($term) {
            $term = current($term);
            $terms[] = array('tid' => $term->tid);
          }
          elseif (!empty($value)) {
            throw new FeedsValidationException(t('Sector "@term" not found in cluster vocabulary.', array('@term' => $value)));
          }
        }
        $target_resource->field_cluster[LANGUAGE_NONE] = $terms;
        break;



      // keywords
      // The most complex part because vocabularies and terms are serialized:
      // field keywords_parents:
      // voc_name1 | voc_name2 | ...
      // field keywords_terms:
      // term1 for voc1, term2 for voc2... | term1 for voc2, term2 for voc2...
      case 'keywords_parents':
        $target_resource->tmp['keywords_parents'] = $value;
        break;
      case 'keywords_terms':
        $vocabularies = array_filter(explode('|', $target_resource->tmp['keywords_parents']));
        $lists_of_terms = array_filter(explode('|', $value));

        // load matching array
        $matching = $this->getVocabularyFields();

        for ($i = 0; $i < count($vocabularies); $i++) {

          $vocabulary_name = trim($vocabularies[$i]);
          $terms = array_filter(explode(',', $lists_of_terms[$i]));

          $matches = array();
          foreach ($terms as $term_name) {
            $term_name = trim($term_name);

            // throw an exception if vocabulary is not in the matching table
            if (!isset($matching[$vocabulary_name])) {
              throw new FeedsValidationException(t('Vocabulary "@vocabulary" not found.', array('@vocabulary' => $vocabulary_name)));
              continue;
            }

            // try to load the term object
            $vid = $matching[$vocabulary_name]['vid'];
            $term = taxonomy_get_term_by_name($term_name, $vid);
            $term = current($term);

            // uncomment to create terms
            // if (!$term && $vid) {
            //  $term = (object) array('name' => $term_name, 'vid' => $vid);
            //  taxonomy_term_save($term);
            // }

            // if we have a valid term object, add to the references array
            if ($term) {
              $matches[] = array('tid' => $term->tid);
            }
            else {
              throw new FeedsValidationException(t('@term not found in vocabulary @vocabulary.', array('@term' => $term_name, '@vocabulary' => $vocabulary_name)));
            }
          }

          // set field value
          if (count($matches)) {
            $target_resource->{$matching[$vocabulary_name]['field_name']}[LANGUAGE_NONE] = $matches;
          }
        }
        break;


      // file upload
      case 'upload':
        //@todo cardinality ?
        if (!preg_match('/^http/i', $value)) {
          $value = PATH_LEZOO_FILES . $value;
        }
        else {
          $value = rawurldecode($value);
        }
        $target_element = 'field_file';
        file_feeds_set_target($source, $target_resource, $target_element, $value);
        break;

      case 'cover':
        if (!preg_match('/^http/i', $value)) {
          $value = PATH_LEZOO_FILES . $value;
        }
        else {
          $value = rawurldecode($value);
        }
        $target_element = 'field_image';
        file_feeds_set_target($source, $target_resource, $target_element, $value);
        break;

      default:
        parent::setTargetElement($source, $target_resource, $target_element, $value);
        break;
    }

  }


  /**
   * Return available mapping targets.
   */
  public function getMappingTargets() {
    $targets = parent::getMappingTargets();
    $targets['rid'] = array(
      'name' => 'Resource id',
      'description' => t('Resource ID'),
    );
    $targets['title'] = array(
      'name' => 'Title',
      'description' => t('Title'),
    );
    $targets['uid'] = array(
      'name' => 'User id',
      'description' => t('User ID'),
    );
    $targets['description'] = array(
      'name' => 'Description',
      'description' => t('Description'),
    );
    $targets['date'] = array(
      'name' => 'Published date',
      'description' => t('Published date. Allowed format: DD*MM*YYYY, MM*YYYY, YYYY. * means -, / or space.'),
    );
    $targets['type_parent'] = array(
      'name' => 'Type (parent)',
      'description' => t('Parent term for type.'),
    );
    $targets['type_term'] = array(
      'name' => 'Type (term)',
      'description' => t('Type (term)'),
    );
    $targets['sector1'] = array(
      'name' => 'Sector 1',
      'description' => t('Sector 1'),
    );
    $targets['sector2'] = array(
      'name' => 'Sector 2',
      'description' => t('Sector 2'),
    );
    $targets['keywords_parents'] = array(
      'name' => 'Keywords parent(s)',
      'description' => t('Vocabularies separated by |'),
    );
    $targets['keywords_terms'] = array(
      'name' => 'Keywords terms',
      'description' => t('List of terms separated by |. Each list contains terms separated by colon.'),
    );
    $targets['upload'] = array(
      'name' => 'Upload',
      'description' => t('Filename or URL. The file will be taken from the migration directory or via CURL if a path is provided.'),
    );
    $targets['cover'] = array(
      'name' => 'Cover',
      'description' => t('An image to illustrate the resource'),
    );
    $targets['multiple_publishers'] = array(
      'name' => 'Multiple publishers',
      'description' => t('List of publishers separated by a pipe character.'),
    );
    $targets['multiple_locations'] = array(
      'name' => 'Multiple locations',
      'description' => t('List of locations separated by a pipe character.'),
    );
    $info_instances = field_info_instances('shelter_resource', 'shelter_resource');

    foreach ($info_instances as $field_name => $field_info_instance) {

      $targets[$field_name] = array (
        'name' => $field_info_instance['label'],
        'description' => $field_info_instance['description'],
      );

      $info_field = field_info_field($field_name);
      switch ($info_field['module']) {
        case 'list':
        case 'number':
          if ($info_field['type'] == 'list_text') {
            $targets[$field_name]['callback'] = 'text_feeds_set_target';
          }
          else {
            $targets[$field_name]['callback'] = 'number_feeds_set_target';
          }
          break;
        case 'date':
          $targets[$field_name]['callback'] = 'date_feeds_set_target';
          break;
        case 'image':
        case 'file':
          $targets[$field_name]['callback'] = 'file_feeds_set_target';
          break;
        case 'text':
          $targets[$field_name]['callback'] = 'text_feeds_set_target';
          break;
        case 'taxonomy':
          $targets[$field_name]['callback'] = 'taxonomy_feeds_set_target';
          break;
      }

    }

    // Let other modules expose mapping targets.
    self::loadMappers();
    feeds_alter('feeds_shelter_resource_processor_targets', $targets);
    $entity_type = $bundle = 'shelter_resource';
    drupal_alter('feeds_processor_targets', $targets, $entity_type, $bundle);
    return $targets;
  }

  /**
   * Get id of an existing feed item if available.
   */
  protected function existingEntityId(FeedsSource $source, FeedsParserResult $result) {
    if ($rid = parent::existingEntityId($source, $result)) {
      return $rid;
    }

    foreach ($this->uniqueTargets($source, $result) as $target => $value) {
      switch ($target) {
        case 'guid':
          $params = array(
            ':feed_nid' => $source->feed_nid,
            ':id' => $source->id,
            ':guid' => $value,
          );
          $rid = db_query("SELECT entity_id FROM {feeds_item} WHERE feed_nid = :feed_nid AND id = :id AND guid = :guid", $params)->fetchField();
          break;
      }
      if ($rid) {
        return $rid;
      }
    }
    return 0;
  }


  /**
   * Builds and returns an array of vocabulary fields used by the entity.
   * This helper is used to map a keyword to his field (the field that
   * references terms from a specific vocabulary).
   */
  private function getVocabularyFields() {
    $cache = &drupal_static(__FUNCTION__);
    if (!isset($cache)) {
      $cache = array();
      $fields = field_info_instances('shelter_resource', 'shelter_resource');
      foreach (array_keys($fields) as $field_name) {
        $field = field_info_field($field_name);
        if ($field['type'] == 'taxonomy_term_reference') {
          $vocabulary_name = $field['settings']['allowed_values'][0]['vocabulary'];
          $vocabulary = taxonomy_vocabulary_machine_name_load($vocabulary_name);
          $cache[$vocabulary->name] = array('field_name' => $field_name, 'vid' => $vocabulary->vid);
        }
      }
    }
    return $cache;
  }

}
