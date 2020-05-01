<?php

namespace Drupal\tca_commerce_product;

use Drupal\Core\Access\AccessResultAllowed;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\entity\EntityAccessControlHandler;

/**
 * Extended access control handler for node entity.
 */
class TcaCommerceProductAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  public function access(EntityInterface $entity, $operation, AccountInterface $account = NULL, $return_as_object = FALSE) {
    // Allow users without the permission "access content"
    // to 'view' the commerce_product by providing URL token.
    $access = parent::access($entity, $operation, $account, $return_as_object);
    if ($operation === 'view' && $entity->get('tca_active')->getString()) {
      // Compare token from URL with commerce_product token.
      $token_match = $entity->get('tca_token')->getString() === $this->getRequestStack()->getCurrentRequest()->get('tca');
      return $token_match ? AccessResultAllowed::allowed() : $access;
    }
    return $access;
  }

  /**
   * Current request stack.
   *
   * @return \Symfony\Component\HttpFoundation\RequestStack
   *   Request stack.
   */
  protected function getRequestStack() {
    return \Drupal::service('request_stack');
  }

}
