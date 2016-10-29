<?php

namespace Drupal\virtual_tour\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Equirectangular edit forms.
 *
 * @ingroup virtual_tour
 */
class EquirectangularForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\virtual_tour\Entity\Equirectangular */
    $form = parent::buildForm($form, $form_state);

    $entity = $this->entity;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = &$this->entity;

    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Equirectangular.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Equirectangular.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.equirectangular.canonical', ['equirectangular' => $entity->id()]);
  }

}
