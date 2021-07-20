<?php

namespace Drupal\info_fetcher\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;


/**
 * Defines the FetchedInfo entity.
 *
 * @ContentEntityType(
 *   id = "fetched_info",
 *   label = @Translation("Fetched Info"),
 *   bundle_label = @Translation("Fetched Info Type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\info_fetcher\FetchedInfoListBuilder",
 *     "form" = {
 *       "default" = "Drupal\info_fetcher\Form\FetchedInfoForm",
 *       "add" = "Drupal\info_fetcher\Form\FetchedInfoForm",
 *       "edit" = "Drupal\info_fetcher\Form\FetchedInfoForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *     },
 *    "route_provider" = {
 *      "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider"
 *    }
 *   },
 *   base_table = "fetched_info",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "created",
 *     "uuid" = "uuid",
 *     "bundle" = "type",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/fetched_info/{fetched_info}",
 *     "add-page" = "/admin/structure/fetched_info/add",
 *     "add-form" = "/admin/structure/fetched_info/add/{fetched_info_type}",
 *     "edit-form" = "/admin/structure/fetched_info/{fetched_info}/edit",
 *     "delete-form" = "/admin/structure/fetched_info/{fetched_info}/delete",
 *     "collection" = "/admin/structure/fetched_info",
 *   },
 *   bundle_entity_type = "fetched_info_type",
 *   field_ui_base_route = "entity.fetched_info_type.edit_form"
 * )
 */
class FetchedInfo extends ContentEntityBase implements FetchedInfoInterface {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public function getSource() {
    return $this->get('source')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setSource($source) {
    $this->set('source', $source);
    return $this;
  }

    /**
   * {@inheritdoc}
   */
  public function getFetchedData() {
    return $this->get('fetched_data')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setFetchedData($fetched_data) {
    $this->set('fetched_data', $fetched_data);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);


    $fields['source'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Source'))
      ->setDescription(t('The source.'))
      ->setSettings([
        'max_length' => 255,
        'text_processing' => 0,
      ])
      ->setDefaultValue('');

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'))

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));


      $fields['fetched_data'] = BaseFieldDefinition::create('string_long')
      ->setLabel(t('Fetched Data'))
      ->setDescription(t('The raw data retrieved from an api.'))
      ->setDefaultValue('')
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    return $fields;
  }
}
