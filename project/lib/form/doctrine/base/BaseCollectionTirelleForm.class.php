<?php

/**
 * CollectionTirelle form base class.
 *
 * @method CollectionTirelle getObject() Returns the current form's model object
 *
 * @package    nathanmode
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCollectionTirelleForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'collection_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Collection'), 'add_empty' => false)),
      'date_expedition'   => new sfWidgetFormDate(),
      'colori'            => new sfWidgetFormInputText(),
      'metrage'           => new sfWidgetFormInputText(),
      'bain'              => new sfWidgetFormInputText(),
      'date_validation'   => new sfWidgetFormDate(),
      'date_refusation'   => new sfWidgetFormDate(),
      'date_retraitement' => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'collection_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Collection'))),
      'date_expedition'   => new sfValidatorDate(array('required' => false)),
      'colori'            => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'metrage'           => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'bain'              => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'date_validation'   => new sfValidatorDate(array('required' => false)),
      'date_refusation'   => new sfValidatorDate(array('required' => false)),
      'date_retraitement' => new sfValidatorDate(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('collection_tirelle[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CollectionTirelle';
  }

}
