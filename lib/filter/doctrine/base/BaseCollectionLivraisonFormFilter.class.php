<?php

/**
 * CollectionLivraison filter form base class.
 *
 * @package    nathanmode
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCollectionLivraisonFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'collection_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Collection'), 'add_empty' => true)),
      'devise_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'), 'add_empty' => true)),
      'escompte_devise_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EscompteDevise'), 'add_empty' => true)),
      'facture_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Facture'), 'add_empty' => true)),
      'colori'             => new sfWidgetFormFilterInput(),
      'metrage'            => new sfWidgetFormFilterInput(),
      'piece_categorie'    => new sfWidgetFormFilterInput(),
      'piece'              => new sfWidgetFormFilterInput(),
      'prix'               => new sfWidgetFormFilterInput(),
      'escompte'           => new sfWidgetFormFilterInput(),
      'adresse_livraison'  => new sfWidgetFormFilterInput(),
      'date'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'num_facture'        => new sfWidgetFormFilterInput(),
      'fichier'            => new sfWidgetFormFilterInput(),
      'packing_list'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'collection_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Collection'), 'column' => 'id')),
      'devise_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Devise'), 'column' => 'id')),
      'escompte_devise_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('EscompteDevise'), 'column' => 'id')),
      'facture_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Facture'), 'column' => 'id')),
      'colori'             => new sfValidatorPass(array('required' => false)),
      'metrage'            => new sfValidatorPass(array('required' => false)),
      'piece_categorie'    => new sfValidatorPass(array('required' => false)),
      'piece'              => new sfValidatorPass(array('required' => false)),
      'prix'               => new sfValidatorPass(array('required' => false)),
      'escompte'           => new sfValidatorPass(array('required' => false)),
      'adresse_livraison'  => new sfValidatorPass(array('required' => false)),
      'date'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'num_facture'        => new sfValidatorPass(array('required' => false)),
      'fichier'            => new sfValidatorPass(array('required' => false)),
      'packing_list'       => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('collection_livraison_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CollectionLivraison';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'collection_id'      => 'ForeignKey',
      'devise_id'          => 'ForeignKey',
      'escompte_devise_id' => 'ForeignKey',
      'facture_id'         => 'ForeignKey',
      'colori'             => 'Text',
      'metrage'            => 'Text',
      'piece_categorie'    => 'Text',
      'piece'              => 'Text',
      'prix'               => 'Text',
      'escompte'           => 'Text',
      'adresse_livraison'  => 'Text',
      'date'               => 'Date',
      'num_facture'        => 'Text',
      'fichier'            => 'Text',
      'packing_list'       => 'Text',
    );
  }
}
