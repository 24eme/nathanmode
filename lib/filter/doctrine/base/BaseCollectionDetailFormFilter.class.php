<?php

/**
 * CollectionDetail filter form base class.
 *
 * @package    nathanmode
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCollectionDetailFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'collection_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Collection'), 'add_empty' => true)),
      'devise_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'), 'add_empty' => true)),
      'commande_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Commande'), 'add_empty' => true)),
      'colori'                 => new sfWidgetFormFilterInput(),
      'metrage'                => new sfWidgetFormFilterInput(),
      'piece_categorie'        => new sfWidgetFormFilterInput(),
      'piece'                  => new sfWidgetFormFilterInput(),
      'prix'                   => new sfWidgetFormFilterInput(),
      'image'                  => new sfWidgetFormFilterInput(),
      'prix_achat'             => new sfWidgetFormFilterInput(),
      'prix_public'            => new sfWidgetFormFilterInput(),
      'part_frais'             => new sfWidgetFormFilterInput(),
      'part_marge'             => new sfWidgetFormFilterInput(),
      'part_commission'        => new sfWidgetFormFilterInput(),
      'date_livraison_prevue'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'reste_a_livrer_produit' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'collection_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Collection'), 'column' => 'id')),
      'devise_id'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Devise'), 'column' => 'id')),
      'commande_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Commande'), 'column' => 'id')),
      'colori'                 => new sfValidatorPass(array('required' => false)),
      'metrage'                => new sfValidatorPass(array('required' => false)),
      'piece_categorie'        => new sfValidatorPass(array('required' => false)),
      'piece'                  => new sfValidatorPass(array('required' => false)),
      'prix'                   => new sfValidatorPass(array('required' => false)),
      'image'                  => new sfValidatorPass(array('required' => false)),
      'prix_achat'             => new sfValidatorPass(array('required' => false)),
      'prix_public'            => new sfValidatorPass(array('required' => false)),
      'part_frais'             => new sfValidatorPass(array('required' => false)),
      'part_marge'             => new sfValidatorPass(array('required' => false)),
      'part_commission'        => new sfValidatorPass(array('required' => false)),
      'date_livraison_prevue'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'reste_a_livrer_produit' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('collection_detail_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CollectionDetail';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'collection_id'          => 'ForeignKey',
      'devise_id'              => 'ForeignKey',
      'commande_id'            => 'ForeignKey',
      'colori'                 => 'Text',
      'metrage'                => 'Text',
      'piece_categorie'        => 'Text',
      'piece'                  => 'Text',
      'prix'                   => 'Text',
      'image'                  => 'Text',
      'prix_achat'             => 'Text',
      'prix_public'            => 'Text',
      'part_frais'             => 'Text',
      'part_marge'             => 'Text',
      'part_commission'        => 'Text',
      'date_livraison_prevue'  => 'Date',
      'reste_a_livrer_produit' => 'Text',
    );
  }
}
