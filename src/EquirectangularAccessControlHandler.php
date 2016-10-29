<?php

namespace Drupal\virtual_tour;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Equirectangular entity.
 *
 * @see \Drupal\virtual_tour\Entity\Equirectangular.
 */
class EquirectangularAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\virtual_tour\Entity\EquirectangularInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished equirectangular entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published equirectangular entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit equirectangular entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete equirectangular entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add equirectangular entities');
  }

}
