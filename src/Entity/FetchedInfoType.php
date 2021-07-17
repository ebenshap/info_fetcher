<?php
namespace Drupal\info_fetcher\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * FetchedInfo type configuration entity type.
 *
 * @ConfigEntityType(
 *   id = "fetched_info_type",
 *   label = @Translation("FetchedInfo type"),
 *   handlers = {
 *     "list_builder" = "Drupal\info_fetcher\FetchedInfoTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\info_fetcher\Form\FetchedInfoTypeForm",
 *       "edit" = "Drupal\info_fetcher\Form\FetchedInfoTypeForm",
 *       "delete" = "Drupal\info_fetcher\Form\FetchedInfoTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "fetched_info_type",
 *   config_export = { 
 *     "id",
 *     "label"},
 *   admin_permission = "administer site configuration",
 *   bundle_of = "fetched_info",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/fetched_info_type/{fetched_info_type}",
 *     "add-form" = "/admin/structure/fetched_info_type/add",
 *     "edit-form" = "/admin/structure/fetched_info_type/{fetched_info_type}/edit",
 *     "delete-form" = "/admin/structure/fetched_info_type/{fetched_info_type}/delete",
 *     "collection" = "/admin/structure/fetched_info_type"
 *   }
 * )
 */
class FetchedInfoType extends ConfigEntityBundleBase implements FetchedInfoTypeInterface  {

  /**
   * The FetchedInfo type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The FetchedInfo type label.
   *
   * @var string
   */
  protected $label;

}
