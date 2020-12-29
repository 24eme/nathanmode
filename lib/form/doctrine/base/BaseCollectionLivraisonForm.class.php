<?php

/**
 * CollectionLivraison form base class.
 *
 * @method CollectionLivraison getObject() Returns the current form's model object
 *
 * @package    nathanmode
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCollectionLivraisonForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'collection_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Collection'), 'add_empty' => false)),
      'devise_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'), 'add_empty' => false)),
      'escompte_devise_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EscompteDevise'), 'add_empty' => false)),
      'facture_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Facture'), 'add_empty' => false)),
      'colori'             => new sfWidgetFormInputText(),
      'metrage'            => new sfWidgetFormInputText(),
      'piece_categorie'    => new sfWidgetFormInputText(),
      'piece'              => new sfWidgetFormInputText(),
      'prix'               => new sfWidgetFormInputText(),
      'escompte'           => new sfWidgetFormInputText(),
      'adresse_livraison'  => new sfWidgetFormInputText(),
      'date'               => new sfWidgetFormDate(),
      'num_facture'        => new sfWidgetFormInputText(),
      'fichier'            => new sfWidgetFormInputText(),
      'packing_list'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'collection_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Collection'))),
      'devise_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'))),
      'escompte_devise_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('EscompteDevise'))),
      'facture_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Facture'))),
      'colori'             => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'metrage'            => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'piece_categorie'    => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'piece'              => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'prix'               => new sfValidatorPass(array('required' => false)),
      'escompte'           => new sfValidatorPass(array('required' => false)),
      'adresse_livraison'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'date'               => new sfValidatorDate(array('required' => false)),
      'num_facture'        => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'fichier'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'packing_list'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('collection_livraison[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CollectionLivraison';
  }

}
