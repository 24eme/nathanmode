<?php

/**
 * CollectionRetard form base class.
 *
 * @method CollectionRetard getObject() Returns the current form's model object
 *
 * @package    nathanmode
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCollectionRetardForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'collection_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Collection'), 'add_empty' => false)),
      'date'            => new sfWidgetFormDate(),
      'observation'     => new sfWidgetFormInputText(),
      'qualite'         => new sfWidgetFormInputText(),
      'piece_categorie' => new sfWidgetFormInputText(),
      'colori'          => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'collection_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Collection'))),
      'date'            => new sfValidatorDate(array('required' => false)),
      'observation'     => new sfValidatorPass(array('required' => false)),
      'qualite'         => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'piece_categorie' => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'colori'          => new sfValidatorString(array('max_length' => 128, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('collection_retard[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CollectionRetard';
  }

}
