<?php

/**
 * LabDip form base class.
 *
 * @method LabDip getObject() Returns the current form's model object
 *
 * @package    nathanmode
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLabDipForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'saison_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Saison'), 'add_empty' => false)),
      'fournisseur_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => false)),
      'client_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Client'), 'add_empty' => false)),
      'article'        => new sfWidgetFormInputText(),
      'colori'         => new sfWidgetFormInputText(),
      'date_envoi'     => new sfWidgetFormDate(),
      'statut'         => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'saison_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Saison'))),
      'fournisseur_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'))),
      'client_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Client'))),
      'article'        => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'colori'         => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'date_envoi'     => new sfValidatorDate(array('required' => false)),
      'statut'         => new sfValidatorString(array('max_length' => 128, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lab_dip[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LabDip';
  }

}
