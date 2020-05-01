<?php

namespace Drupal\tca_commerce_product\Plugin\TcaPlugin;

use Drupal\tca\Plugin\TcaPluginBase;

/**
 * Implements TCA for commerce products.
 *
 * @TcaPlugin(
 *  id = "tca_commerce_product",
 *  label = @Translation("Product"),
 *  entityType = "commerce_product"
 * )
 */
class Product extends TcaPluginBase {

  /**
   * {@inheritdoc}
   */
  public function isFieldable() {
    return TRUE;
  }

  /**
   * {@inheritdoc}
   */
  public function getFormSubmitHandlerAttachLocations() {
    return [
      ['actions', 'submit', '#submit'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getBundleFormSubmitHandlerAttachLocations() {
    return [
      ['actions', 'submit', '#submit'],
      ['actions', 'save_continue', '#submit'],
    ];
  }

}
