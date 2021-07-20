<?php
namespace Drupal\info_fetcher\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\info_fetcher\Entity\FetchedInfoTypeInterface;

/**
 * Form handler for creating/editing FetchedInfoType entities
 */
class FetchedInfoTypeForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    /** @var FetchedInfoTypeInterface $fetched_info_type */
    $fetched_info_type = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $fetched_info_type->label(),
      '#description' => $this->t('Label for the Fetched_info type.'),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $fetched_info_type->id(),
      '#machine_name' => [
        'exists' => '\Drupal\info_fetcher\Entity\FetchedInfoType::load',
      ],
      '#disabled' => !$fetched_info_type->isNew(),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $fetched_info_type = $this->entity;
    $status = $fetched_info_type->save();

    switch ($status) {
      case SAVED_NEW:
        \Drupal::messenger()->addStatus($this->t('Created the %label Fetched_info type.', [
          '%label' => $fetched_info_type->label(),
        ]));
        break;

      default:
        \Drupal::messenger()->addStatus($this->t('Saved the %label Fetched_info type.', [
          '%label' => $fetched_info_type->label(),
        ]));
    }
    $form_state->setRedirectUrl($fetched_info_type->toUrl('collection'));
  }

}
