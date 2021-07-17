<?php

namespace Drupal\info_fetcher\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a InfoFetcher plugin item annotation object.
 *
 * @see \Drupal\thing\Plugin\InfoFetcherManager
 * @see plugin_api
 *
 * @Annotation
 */
class InfoFetcher extends Plugin {


  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The label of the plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $label;

}
