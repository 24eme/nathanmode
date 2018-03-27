<?php

/**
 * Commande filter form base class.
 *
 * @package    nathanmode
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCommandeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'saison_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Saison'), 'add_empty' => true)),
      'fournisseur_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
      'commercial_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Commercial'), 'add_empty' => true)),
      'client_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Client'), 'add_empty' => true)),
      'devise_montant_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DeviseMontant'), 'add_empty' => true)),
      'devise_fournisseur_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DeviseFournisseur'), 'add_empty' => true)),
      'devise_commercial_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DeviseCommercial'), 'add_empty' => true)),
      'prix_fournisseur'      => new sfWidgetFormFilterInput(),
      'prix_commercial'       => new sfWidgetFormFilterInput(),
      'total_fournisseur'     => new sfWidgetFormFilterInput(),
      'total_commercial'      => new sfWidgetFormFilterInput(),
      'numero'                => new sfWidgetFormFilterInput(),
      'date'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'montant'               => new sfWidgetFormFilterInput(),
      'colori'                => new sfWidgetFormFilterInput(),
      'metrage'               => new sfWidgetFormFilterInput(),
      'qualite'               => new sfWidgetFormFilterInput(),
      'situation'             => new sfWidgetFormFilterInput(),
      'relation'              => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'saison_id'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Saison'), 'column' => 'id')),
      'fournisseur_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Fournisseur'), 'column' => 'id')),
      'commercial_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Commercial'), 'column' => 'id')),
      'client_id'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Client'), 'column' => 'id')),
      'devise_montant_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('DeviseMontant'), 'column' => 'id')),
      'devise_fournisseur_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('DeviseFournisseur'), 'column' => 'id')),
      'devise_commercial_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('DeviseCommercial'), 'column' => 'id')),
      'prix_fournisseur'      => new sfValidatorPass(array('required' => false)),
      'prix_commercial'       => new sfValidatorPass(array('required' => false)),
      'total_fournisseur'     => new sfValidatorPass(array('required' => false)),
      'total_commercial'      => new sfValidatorPass(array('required' => false)),
      'numero'                => new sfValidatorPass(array('required' => false)),
      'date'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'montant'               => new sfValidatorPass(array('required' => false)),
      'colori'                => new sfValidatorPass(array('required' => false)),
      'metrage'               => new sfValidatorPass(array('required' => false)),
      'qualite'               => new sfValidatorPass(array('required' => false)),
      'situation'             => new sfValidatorPass(array('required' => false)),
      'relation'              => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('commande_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Commande';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'saison_id'             => 'ForeignKey',
      'fournisseur_id'        => 'ForeignKey',
      'commercial_id'         => 'ForeignKey',
      'client_id'             => 'ForeignKey',
      'devise_montant_id'     => 'ForeignKey',
      'devise_fournisseur_id' => 'ForeignKey',
      'devise_commercial_id'  => 'ForeignKey',
      'prix_fournisseur'      => 'Text',
      'prix_commercial'       => 'Text',
      'total_fournisseur'     => 'Text',
      'total_commercial'      => 'Text',
      'numero'                => 'Text',
      'date'                  => 'Date',
      'montant'               => 'Text',
      'colori'                => 'Text',
      'metrage'               => 'Text',
      'qualite'               => 'Text',
      'situation'             => 'Text',
      'relation'              => 'Text',
    );
  }
}
