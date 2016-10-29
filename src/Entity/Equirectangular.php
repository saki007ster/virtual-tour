<?php

namespace Drupal\virtual_tour\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Equirectangular entity.
 *
 * @ingroup virtual_tour
 *
 * @ContentEntityType(
 *   id = "equirectangular",
 *   label = @Translation("Equirectangular"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\virtual_tour\EquirectangularListBuilder",
 *     "views_data" = "Drupal\virtual_tour\Entity\EquirectangularViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\virtual_tour\Form\EquirectangularForm",
 *       "add" = "Drupal\virtual_tour\Form\EquirectangularForm",
 *       "edit" = "Drupal\virtual_tour\Form\EquirectangularForm",
 *       "delete" = "Drupal\virtual_tour\Form\EquirectangularDeleteForm",
 *     },
 *     "access" = "Drupal\virtual_tour\EquirectangularAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\virtual_tour\EquirectangularHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "equirectangular",
 *   data_table = "equirectangular_field_data",
 *   admin_permission = "administer equirectangular entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/virtual-tour/equirectangular/{equirectangular}",
 *     "add-form" = "/admin/structure/virtual-tour/equirectangular/add",
 *     "edit-form" = "/admin/structure/virtual-tour/equirectangular/{equirectangular}/edit",
 *     "delete-form" = "/admin/structure/virtual-tour/equirectangular/{equirectangular}/delete",
 *     "collection" = "/admin/structure/virtual-tour/equirectangular",
 *   },
 *   field_ui_base_route = "equirectangular.settings"
 * )
 */
class Equirectangular extends ContentEntityBase implements EquirectangularInterface {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += array(
      'user_id' => \Drupal::currentUser()->id(),
    );
  }

  public function label() {
    return $this->get('title')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function getTitle() {
    return $this->get('title')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setTitle($title) {
    $this->set('title', $title);
    return $this;
  }

//  /**
//   * {@inheritdoc}
//   */
//  public function getPanoramaImage() {
//    return $this->get('title')->value;
//  }
//
//  /**
//   * {@inheritdoc}
//   */
//  public function setPanoramaImage($title) {
//    $this->set('title', $title);
//    return $this;
//  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('user_id')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('user_id')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('user_id', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('user_id', $account->id());
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isPublished() {
    return (bool) $this->getEntityKey('status');
  }

  /**
   * {@inheritdoc}
   */
  public function setPublished($published) {
    $this->set('status', $published ? TRUE : FALSE);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the Equirectangular entity.'))
      ->setRevisionable(TRUE)
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setTranslatable(TRUE)
      ->setDisplayOptions('view', array(
        'label' => 'hidden',
        'type' => 'author',
        'weight' => 0,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'entity_reference_autocomplete',
        'weight' => 5,
        'settings' => array(
          'match_operator' => 'CONTAINS',
          'size' => '60',
          'autocomplete_type' => 'tags',
          'placeholder' => '',
        ),
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['title'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Title'))
      ->setDescription(t('The title of the Equirectangular virtual tour.'))
      ->setSettings(array(
        'max_length' => 50,
        'text_processing' => 0,
      ))
      ->setDefaultValue('')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
        'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['panaroma_image'] = BaseFieldDefinition::create('image')
      ->setLabel(t('Panorama Image'))
      ->setRequired(TRUE)
      ->setDisplayOptions('view', [
        'label'   => 'above',
        'type'    => 'image',
        'weight'  => 0,
      ])
      ->setDisplayOptions('form', [
        'type'    => 'image_image',
        'weight'  => 0,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', FALSE);

    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Publishing status'))
      ->setDescription(t('A boolean indicating whether the Equirectangular is published.'))
      ->setDefaultValue(TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

}
