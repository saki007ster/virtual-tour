<?php

/**
 * @file
 * Contains equirectangular.page.inc.
 *
 * Page callback for Equirectangular entities.
 */

use Drupal\Core\Render\Element;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Prepares variables for Equirectangular templates.
 *
 * Default template: equirectangular.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_equirectangular(array &$variables) {
  // Fetch Equirectangular Entity Object.
  $equirectangular = $variables['elements']['#equirectangular'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
