<?php

/**
 * LabDipDetail form base class.
 *
 * @method LabDipDetail getObject() Returns the current form's model object
 *
 * @package    nathanmode
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLabDipDetailForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'lab_dip_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LabDip'), 'add_empty' => false)),
      'date'       => new sfWidgetFormDate(),
      'statut'     => new sfWidgetFormInputText(),
      'reference'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'lab_dip_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('LabDip'))),
      'date'       => new sfValidatorDate(array('required' => false)),
      'statut'     => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'reference'  => new sfValidatorString(array('max_length' => 128, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lab_dip_detail[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LabDipDetail';
  }

}
