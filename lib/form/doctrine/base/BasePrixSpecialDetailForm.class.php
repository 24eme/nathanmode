<?php

/**
 * PrixSpecialDetail form base class.
 *
 * @method PrixSpecialDetail getObject() Returns the current form's model object
 *
 * @package    nathanmode
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePrixSpecialDetailForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'prix_special_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PrixSpecial'), 'add_empty' => false)),
      'devise_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'), 'add_empty' => false)),
      'prix'            => new sfWidgetFormInputText(),
      'quantite'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'prix_special_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PrixSpecial'))),
      'devise_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'))),
      'prix'            => new sfValidatorPass(array('required' => false)),
      'quantite'        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('prix_special_detail[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PrixSpecialDetail';
  }

}
