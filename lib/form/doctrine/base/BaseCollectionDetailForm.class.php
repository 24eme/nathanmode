<?php

/**
 * CollectionDetail form base class.
 *
 * @method CollectionDetail getObject() Returns the current form's model object
 *
 * @package    nathanmode
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCollectionDetailForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'collection_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Collection'), 'add_empty' => false)),
      'devise_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'), 'add_empty' => false)),
      'commande_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Commande'), 'add_empty' => false)),
      'colori'          => new sfWidgetFormInputText(),
      'metrage'         => new sfWidgetFormInputText(),
      'piece_categorie' => new sfWidgetFormInputText(),
      'piece'           => new sfWidgetFormInputText(),
      'prix'            => new sfWidgetFormInputText(),
      'image'           => new sfWidgetFormInputText(),
      'prix_achat'      => new sfWidgetFormInputText(),
      'prix_public'     => new sfWidgetFormInputText(),
      'part_frais'      => new sfWidgetFormInputText(),
      'part_marge'      => new sfWidgetFormInputText(),
      'part_commission' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'collection_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Collection'))),
      'devise_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'))),
      'commande_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Commande'))),
      'colori'          => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'metrage'         => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'piece_categorie' => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'piece'           => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'prix'            => new sfValidatorPass(array('required' => false)),
      'image'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'prix_achat'      => new sfValidatorPass(array('required' => false)),
      'prix_public'     => new sfValidatorPass(array('required' => false)),
      'part_frais'      => new sfValidatorPass(array('required' => false)),
      'part_marge'      => new sfValidatorPass(array('required' => false)),
      'part_commission' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('collection_detail[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CollectionDetail';
  }

}
