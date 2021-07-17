<?php

namespace Drupal\info_fetcher\Plugin;

use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;

/**
 * Provides the Example plugin plugin manager.
 */
class InfoFetcherManager extends DefaultPluginManager {


  /**
   * Constructs a new InfoFetcherManager object.
   *
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler to invoke the alter hook with.
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct('Plugin/InfoFetcher', $namespaces, $module_handler, 'Drupal\info_fetcher\Plugin\InfoFetcherInterface', 'Drupal\info_fetcher\Annotation\InfoFetcher');

    $this->alterInfo('info_fetcher_info_fetcher_info');
    $this->setCacheBackend($cache_backend, 'info_fetcher_info_fetcher_plugins');
  }

}
