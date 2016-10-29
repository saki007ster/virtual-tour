<?php

namespace Drupal\virtual_tour\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Equirectangular entities.
 */
class EquirectangularViewsData extends EntityViewsData implements EntityViewsDataInterface {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['equirectangular']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Equirectangular'),
      'help' => $this->t('The Equirectangular ID.'),
    );

    return $data;
  }

}
