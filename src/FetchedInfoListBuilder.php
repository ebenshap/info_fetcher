<?php
namespace Drupal\info_fetcher;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * EntityListBuilderInterface implementation responsible for the Fetched_info entities.
 */
class FetchedInfoListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Fetched_info ID');
    $header['name'] = $this->t('Fetched Data');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\info_fetcher\Entity\FetchedInfo */
    $row['id'] = $entity->id();
    $row['name'] = Link::fromTextAndUrl(
      $entity->label(),
      new Url(
        'entity.fetched_info.canonical', [
          'fetched_info' => $entity->id(),
        ]
      )
    );
    return $row + parent::buildRow($entity);
  }

}
