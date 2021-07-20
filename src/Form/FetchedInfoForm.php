<?php
namespace Drupal\info_fetcher\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form for creating/editing Fetched_info entities.
 */
class FetchedInfoForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\info_fetcher\Entity\FetchedInfo */
    $form = parent::buildForm($form, $form_state);
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = &$this->entity;

    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        \Drupal::messenger()->addStatus($this->t('Created the %label Fetched_info.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        \Drupal::messenger()->addStatus($this->t('Saved the %label Fetched_info.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.fetched_info.canonical', ['fetched_info' => $entity->id()]);
  }

}
