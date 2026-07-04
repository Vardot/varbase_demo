<?php

declare(strict_types=1);

namespace Drupal\varbase_demo\Hook;

use Drupal\Core\Entity\EntityRepositoryInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Hook\Attribute\Hook;
use Drupal\entityqueue\Entity\EntitySubqueue;

/**
 * Hook implementations for the Varbase Demo module.
 */
class VarbaseDemoHooks {

  /**
   * Constructs a VarbaseDemoHooks object.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   *   The entity type manager.
   * @param \Drupal\Core\Entity\EntityRepositoryInterface $entityRepository
   *   The entity repository.
   */
  public function __construct(
    protected EntityTypeManagerInterface $entityTypeManager,
    protected EntityRepositoryInterface $entityRepository,
  ) {}

  /**
   * Implements hook_modules_installed().
   */
  #[Hook('modules_installed')]
  public function modulesInstalled($modules, $is_syncing): void {
    // After the Varbase Demo module finishes installing and all default content
    // nodes are imported, add the default Varbase Hero Slider items to the
    // Varbase Hero Slider entity subqueue.
    if (in_array('varbase_demo', $modules)) {
      $varbase_heroslider_items = [
        '90eef39c-3a53-4575-8aac-0d89241b35ec',
        'f2c18de7-bccc-4713-94be-1749bcf562da',
        '5bffab28-b4db-4ec6-a3ac-751fde856870',
      ];

      $entity_subqueue = $this->entityTypeManager
        ->getStorage('entity_subqueue')
        ->load('varbase_heroslider');
      if (!$entity_subqueue instanceof EntitySubqueue) {
        return;
      }

      foreach ($varbase_heroslider_items as $varbase_heroslider_item_uuid) {
        $varbase_heroslider_node = $this->entityRepository
          ->loadEntityByUuid('node', $varbase_heroslider_item_uuid);
        if ($varbase_heroslider_node) {
          $entity_subqueue->addItem($varbase_heroslider_node);
          $entity_subqueue->save();
        }
      }
    }
  }

}
