<?php
namespace Drupal\info_fetcher\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Represents a Fetched_info entity.
 */
interface FetchedInfoInterface extends ContentEntityInterface, EntityChangedInterface {

  /**
   * Gets the Fetched_info source.
   *
   * @return string
   */
  public function getSource();

  /**
   * Sets the Fetched_info source.
   *
   * @param string $source
   *
   * @return \Drupal\info_fetcher\Entity\FetchedInfoInterface
   *   The called fetched_info entity.
   */
  public function setSource($source);

  /**
   * Gets the fetched_info creation timestamp.
   *
   * @return int
   */
  public function getCreatedTime();

  /**
   * Sets the fetched_info creation timestamp.
   *
   * @param int $timestamp
   *
   * @return \Drupal\info_fetcher\Entity\FetchedInfoInterface
   *   The called Fetched_info entity.
   */
  public function setCreatedTime($timestamp);

}