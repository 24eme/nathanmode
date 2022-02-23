<?php

/**
 * Commercial form base class.
 *
 * @method Commercial getObject() Returns the current form's model object
 *
 * @package    nathanmode
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCommercialForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'devise_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'), 'add_empty' => false)),
      'nom'        => new sfWidgetFormInputText(),
      'prenom'     => new sfWidgetFormInputText(),
      'email'      => new sfWidgetFormInputText(),
      'telephone'  => new sfWidgetFormInputText(),
      'commission' => new sfWidgetFormInputText(),
      'is_super_commercial'   => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'devise_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'))),
      'nom'        => new sfValidatorString(array('max_length' => 128)),
      'prenom'     => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'email'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'telephone'  => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'commission' => new sfValidatorPass(array('required' => false)),
      'is_super_commercial'   => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('commercial[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Commercial';
  }

}
