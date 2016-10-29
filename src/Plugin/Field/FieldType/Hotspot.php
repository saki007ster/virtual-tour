<?php

namespace Drupal\virtual_tour\Plugin\Field\FieldType;

use Drupal\Component\Utility\Random;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'hotspot' field type.
 *
 * @FieldType(
 *   id = "hotspot",
 *   label = @Translation("Hotspot"),
 *   description = @Translation("Used by Virtual Tours"),
 *   default_widget = "hotspot_widget",
 *   default_formatter = "hotspot_formatter",
 * )
 */
class Hotspot extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultStorageSettings() {
    return [
      'type' => ['info', 'scene'],
    ] + parent::defaultStorageSettings();
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    // Prevent early t() calls by using the TranslatableMarkup.
    $properties['type'] = DataDefinition::create('string')
      ->setLabel(t('Type'))
      ->setDescription(t("Hotspot type"))
      ->setRequired(TRUE);

    $properties['pitch'] = DataDefinition::create('integer')
      ->setLabel(t('Pitch (Number)'))
      ->setDescription(t("Pitch to render at."))
      ->setRequired(TRUE);

    $properties['yaw'] = DataDefinition::create('integer')
      ->setLabel(t('Yaw (Number)'))
      ->setDescription(t("Yaw to render at."))
      ->setRequired(TRUE);

    $properties['text'] = DataDefinition::create('string')
      ->setLabel(t('Text'))
      ->setDescription(t("Title for hotspot"))
      ->setRequired(TRUE);

//    $properties['scene_id'] = DataDefinition::create('string')
//      ->setLabel(t('Scene Id'))
//      ->setDescription(t("Scene Id for hotspot"))
//      ->setRequired(TRUE);

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    $schema = [
      'columns' => [
        'type' => [
          'type' => 'varchar',
          'length' => 32,
          'not null' => TRUE,
          'default' => 'info',
        ],
        'pitch' => [
          'description' => 'Pitch to render at.',
          'type' => 'int',
//          'size' => 'tiny',
          'not null' => FALSE,
        ],
        'yaw' => array(
          'description' => 'Yaw to render at.',
          'type' => 'int',
//          'size' => 'tiny',
          'not null' => FALSE,
        ),
        'text' => array(
          'description' => 'Title for hotspot.',
          'type' => 'varchar',
          'length' => 1024,
        ),
//        'scene_id' => [
//          'type' => 'text',
//          'size' => 'tiny',
//          'not null' => FALSE,
//        ],
      ],
    ];

    return $schema;
  }

  /**
   * {@inheritdoc}
   */
  public function storageSettingsForm(array &$form, FormStateInterface $form_state, $has_data) {
    $elements = [];

    $elements['type'] = [
      '#type' => 'checkboxes',
      '#title' => t('Select type of Hotspots to be used.'),
      '#options' => [
        'info' => t('Info'),
        'scene' => t('Scene'),
      ],
      '#default_value' => $this->getSetting('type'),
    ];

    return $elements;
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('type')->getValue();
    return $value === NULL || $value === '';
  }

}
