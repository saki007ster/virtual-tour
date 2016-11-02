<?php

namespace Drupal\virtual_tour\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'hotspot_widget' widget.
 *
 * @FieldWidget(
 *   id = "hotspot_widget",
 *   label = @Translation("Hotspot widget"),
 *   field_types = {
 *     "hotspot"
 *   }
 * )
 */
class HotspotWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $field_settings = $this->getFieldSettings();
    $options = [];
    foreach ($field_settings['type'] as $key => $value) {
      if ($value) {
        $options[$key] = $value;
      }
    }

    // Set up the form element for this widget.
    $element += array(
      '#type' => 'details',
    );

    $element['type'] = [
      '#type' => 'select',
      '#title' => t('Type'),
      '#options' => $options,
      '#default_value' => isset($items[$delta]->type) ? $items[$delta]->type : 'info',
    ];

    $element['pitch'] = [
      '#type' => 'number',
      '#title' => t('Pitch'),
      '#placeholder' => 'pitch',
      '#min' => -1800,
      '#max' => 1800,
      '#default_value' => isset($items[$delta]->pitch) ? $items[$delta]->pitch : 0,
    ];

    $element['yaw'] = [
      '#type' => 'number',
      '#title' => t('Yaw'),
      '#placeholder' => t('Yaw'),
      '#min' => -1800,
      '#max' => 1800,
      '#default_value' => isset($items[$delta]->yaw) ? $items[$delta]->yaw : 0,
    ];

    $element['text'] = [
      '#type' => 'textfield',
      '#title' => t('Text'),
      '#placeholder' => t('Text'),
      '#default_value' => isset($items[$delta]->text) ? $items[$delta]->text : '',
    ];

    if (isset($options['scene'])) {
      $result = \Drupal::entityQuery('equirectangular')->execute();
      $entity_storage = \Drupal::entityTypeManager()->getStorage('equirectangular');
      $entities =$entity_storage->loadMultiple($result);
      $scene_ids = [];
      foreach ($entities as $entity) {
        $scene_ids[$entity->id()] = $entity->getName();
      }
     $element['scene_id'] = [
       '#title' => t('Scene Id'),
       '#type' => 'select',
       '#options' => array_merge([0 => 'Select Scene'], $scene_ids),
       '#default_value' => isset($items[$delta]->scene_id) ? $items[$delta]->scene_id : '',
     ];
    }

    return $element;
  }

}
