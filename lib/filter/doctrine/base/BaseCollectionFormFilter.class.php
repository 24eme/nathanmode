<?php

/**
 * Collection filter form base class.
 *
 * @package    nathanmode
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCollectionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'saison_id'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Saison'), 'add_empty' => true)),
      'fournisseur_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
      'commercial_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Commercial'), 'add_empty' => true)),
      'client_id'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Client'), 'add_empty' => true)),
      'devise_fournisseur_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DeviseFournisseur'), 'add_empty' => true)),
      'devise_commercial_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DeviseCommercial'), 'add_empty' => true)),
      'paiement'                  => new sfWidgetFormFilterInput(),
      'num_commande'              => new sfWidgetFormFilterInput(),
      'date_commande'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'fichier'                   => new sfWidgetFormFilterInput(),
      'situation'                 => new sfWidgetFormFilterInput(),
      'prix_fournisseur'          => new sfWidgetFormFilterInput(),
      'prix_commercial'           => new sfWidgetFormFilterInput(),
      'qualite'                   => new sfWidgetFormFilterInput(),
      'ecru'                      => new sfWidgetFormFilterInput(),
      'observation_general'       => new sfWidgetFormFilterInput(),
      'observation_tirelle'       => new sfWidgetFormFilterInput(),
      'fiche_client'              => new sfWidgetFormFilterInput(),
      'fiche_technique'           => new sfWidgetFormFilterInput(),
      'observation_client'        => new sfWidgetFormFilterInput(),
      'fichier_confirmation'      => new sfWidgetFormFilterInput(),
      'date_livraison'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'adresse_livraison'         => new sfWidgetFormFilterInput(),
      'reste_a_livrer'            => new sfWidgetFormFilterInput(),
      'observation_livraison'     => new sfWidgetFormFilterInput(),
      'commande_soldee'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'tm_date_expedition'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'tm_refus_test'             => new sfWidgetFormFilterInput(),
      'tm_validation'             => new sfWidgetFormFilterInput(),
      'tm_date_expedition_coteco' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'tm_metrage_coteco'         => new sfWidgetFormFilterInput(),
      'tm_validation_coteco'      => new sfWidgetFormFilterInput(),
      'tm_observation'            => new sfWidgetFormFilterInput(),
      'production'                => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'date_retard'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'nb_relance'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'part_marge'                => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'saison_id'                 => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Saison'), 'column' => 'id')),
      'fournisseur_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Fournisseur'), 'column' => 'id')),
      'commercial_id'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Commercial'), 'column' => 'id')),
      'client_id'                 => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Client'), 'column' => 'id')),
      'devise_fournisseur_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('DeviseFournisseur'), 'column' => 'id')),
      'devise_commercial_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('DeviseCommercial'), 'column' => 'id')),
      'paiement'                  => new sfValidatorPass(array('required' => false)),
      'num_commande'              => new sfValidatorPass(array('required' => false)),
      'date_commande'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fichier'                   => new sfValidatorPass(array('required' => false)),
      'situation'                 => new sfValidatorPass(array('required' => false)),
      'prix_fournisseur'          => new sfValidatorPass(array('required' => false)),
      'prix_commercial'           => new sfValidatorPass(array('required' => false)),
      'qualite'                   => new sfValidatorPass(array('required' => false)),
      'ecru'                      => new sfValidatorPass(array('required' => false)),
      'observation_general'       => new sfValidatorPass(array('required' => false)),
      'observation_tirelle'       => new sfValidatorPass(array('required' => false)),
      'fiche_client'              => new sfValidatorPass(array('required' => false)),
      'fiche_technique'           => new sfValidatorPass(array('required' => false)),
      'observation_client'        => new sfValidatorPass(array('required' => false)),
      'fichier_confirmation'      => new sfValidatorPass(array('required' => false)),
      'date_livraison'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'adresse_livraison'         => new sfValidatorPass(array('required' => false)),
      'reste_a_livrer'            => new sfValidatorPass(array('required' => false)),
      'observation_livraison'     => new sfValidatorPass(array('required' => false)),
      'commande_soldee'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'tm_date_expedition'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'tm_refus_test'             => new sfValidatorPass(array('required' => false)),
      'tm_validation'             => new sfValidatorPass(array('required' => false)),
      'tm_date_expedition_coteco' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'tm_metrage_coteco'         => new sfValidatorPass(array('required' => false)),
      'tm_validation_coteco'      => new sfValidatorPass(array('required' => false)),
      'tm_observation'            => new sfValidatorPass(array('required' => false)),
      'production'                => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'date_retard'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'nb_relance'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'part_marge'                => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('collection_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Collection';
  }

  public function getFields()
  {
    return array(
      'id'                        => 'Number',
      'saison_id'                 => 'ForeignKey',
      'fournisseur_id'            => 'ForeignKey',
      'commercial_id'             => 'ForeignKey',
      'client_id'                 => 'ForeignKey',
      'devise_fournisseur_id'     => 'ForeignKey',
      'devise_commercial_id'      => 'ForeignKey',
      'paiement'                  => 'Text',
      'num_commande'              => 'Text',
      'date_commande'             => 'Date',
      'fichier'                   => 'Text',
      'situation'                 => 'Text',
      'prix_fournisseur'          => 'Text',
      'prix_commercial'           => 'Text',
      'qualite'                   => 'Text',
      'ecru'                      => 'Text',
      'observation_general'       => 'Text',
      'observation_tirelle'       => 'Text',
      'fiche_client'              => 'Text',
      'fiche_technique'           => 'Text',
      'observation_client'        => 'Text',
      'fichier_confirmation'      => 'Text',
      'date_livraison'            => 'Date',
      'adresse_livraison'         => 'Text',
      'reste_a_livrer'            => 'Text',
      'observation_livraison'     => 'Text',
      'commande_soldee'           => 'Boolean',
      'tm_date_expedition'        => 'Date',
      'tm_refus_test'             => 'Text',
      'tm_validation'             => 'Text',
      'tm_date_expedition_coteco' => 'Date',
      'tm_metrage_coteco'         => 'Text',
      'tm_validation_coteco'      => 'Text',
      'tm_observation'            => 'Text',
      'production'                => 'Boolean',
      'date_retard'               => 'Date',
      'nb_relance'                => 'Number',
      'part_marge'                => 'Text',
    );
  }
}
