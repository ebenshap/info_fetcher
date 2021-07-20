<?php
namespace Drupal\info_fetcher\Form;

use Drupal\Core\Entity\EntityConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Form handler for deleting Fetched_infoType entities.
 */
class FetchedInfoTypeDeleteForm extends EntityConfirmFormBase {

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return $this->t('Are you sure you want to delete %name?', 
      [ '%name' => $this->entity->label() ]);
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl() {
    return new Url('entity.fetched_info_type.collection');
  }

  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return $this->t('Delete');
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->entity->delete();

    \Drupal::messenger()->addStatus($this->t('Deleted @entity fetched_info type.', 
      [ '@entity' =>  $this->entity->label() ]));

    $form_state->setRedirectUrl($this->getCancelUrl());
  }

}
