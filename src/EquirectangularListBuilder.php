<?php

namespace Drupal\virtual_tour;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Equirectangular entities.
 *
 * @ingroup virtual_tour
 */
class EquirectangularListBuilder extends EntityListBuilder {

  use LinkGeneratorTrait;

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Equirectangular ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\virtual_tour\Entity\Equirectangular */
    $row['id'] = $entity->id();
    $row['name'] = $this->l(
      $entity->getTitle(),
      new Url(
        'entity.equirectangular.edit_form', array(
          'equirectangular' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}
