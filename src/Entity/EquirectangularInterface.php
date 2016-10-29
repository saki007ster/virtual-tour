<?php

namespace Drupal\virtual_tour\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Equirectangular entities.
 *
 * @ingroup virtual_tour
 */
interface EquirectangularInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Equirectangular title.
   *
   * @return string
   *   Name of the Equirectangular.
   */
  public function getTitle();

  /**
   * Sets the Equirectangular title.
   *
   * @param string $name
   *   The Equirectangular title.
   *
   * @return \Drupal\virtual_tour\Entity\EquirectangularInterface
   *   The called Equirectangular entity.
   */
  public function setTitle($title);

  /**
   * Gets the Equirectangular creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Equirectangular.
   */
  public function getCreatedTime();

  /**
   * Sets the Equirectangular creation timestamp.
   *
   * @param int $timestamp
   *   The Equirectangular creation timestamp.
   *
   * @return \Drupal\virtual_tour\Entity\EquirectangularInterface
   *   The called Equirectangular entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Equirectangular published status indicator.
   *
   * Unpublished Equirectangular are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Equirectangular is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Equirectangular.
   *
   * @param bool $published
   *   TRUE to set this Equirectangular to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\virtual_tour\Entity\EquirectangularInterface
   *   The called Equirectangular entity.
   */
  public function setPublished($published);

}
