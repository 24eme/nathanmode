<?php

/**
 * Fournisseur form base class.
 *
 * @method Fournisseur getObject() Returns the current form's model object
 *
 * @package    nathanmode
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFournisseurForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'devise_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'), 'add_empty' => false)),
      'raison_sociale' => new sfWidgetFormInputText(),
      'prenom'         => new sfWidgetFormInputText(),
      'telephone'      => new sfWidgetFormInputText(),
      'adresse'        => new sfWidgetFormInputText(),
      'code_postal'    => new sfWidgetFormInputText(),
      'ville'          => new sfWidgetFormInputText(),
      'commission'     => new sfWidgetFormInputText(),
      'emails'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'devise_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'))),
      'raison_sociale' => new sfValidatorString(array('max_length' => 128)),
      'prenom'         => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'telephone'      => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'adresse'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'code_postal'    => new sfValidatorString(array('max_length' => 5, 'required' => false)),
      'ville'          => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'commission'     => new sfValidatorPass(array('required' => false)),
      'emails'          => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('fournisseur[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Fournisseur';
  }

}
