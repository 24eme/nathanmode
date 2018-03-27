<?php

/**
 * Client form base class.
 *
 * @method Client getObject() Returns the current form's model object
 *
 * @package    nathanmode
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseClientForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                      => new sfWidgetFormInputHidden(),
      'raison_sociale'          => new sfWidgetFormInputText(),
      'telephone'               => new sfWidgetFormInputText(),
      'adresse_livraison'       => new sfWidgetFormInputText(),
      'code_postal_livraison'   => new sfWidgetFormInputText(),
      'ville_livraison'         => new sfWidgetFormInputText(),
      'adresse_facturation'     => new sfWidgetFormInputText(),
      'code_postal_facturation' => new sfWidgetFormInputText(),
      'ville_facturation'       => new sfWidgetFormInputText(),
      'condition_paiement'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'raison_sociale'          => new sfValidatorString(array('max_length' => 128)),
      'telephone'               => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'adresse_livraison'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'code_postal_livraison'   => new sfValidatorString(array('max_length' => 5, 'required' => false)),
      'ville_livraison'         => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'adresse_facturation'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'code_postal_facturation' => new sfValidatorString(array('max_length' => 5, 'required' => false)),
      'ville_facturation'       => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'condition_paiement'      => new sfValidatorString(array('max_length' => 128, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('client[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Client';
  }

}
