<?php

namespace Drupal\virtual_tour\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class VirtualTour.
 *
 * @package Drupal\virtual_tour\Controller
 */
class VirtualTour extends ControllerBase {

  /**
   * Hello.
   *
   * @return string
   *   Return Hello string.
   */
  public function types() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: hello')
    ];
  }

}
