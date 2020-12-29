<?php

/**
 * Coupe filter form base class.
 *
 * @package    nathanmode
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCoupeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'saison_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Saison'), 'add_empty' => true)),
      'fournisseur_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
      'commercial_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Commercial'), 'add_empty' => true)),
      'client_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Client'), 'add_empty' => true)),
      'devise_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'), 'add_empty' => true)),
      'fournisseur_devise_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DeviseFournisseur'), 'add_empty' => true)),
      'commercial_devise_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DeviseCommercial'), 'add_empty' => true)),
      'commission_fournisseur' => new sfWidgetFormFilterInput(),
      'commission_commercial'  => new sfWidgetFormFilterInput(),
      'facture_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Facture'), 'add_empty' => true)),
      'commande_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Commande'), 'add_empty' => true)),
      'paiement'               => new sfWidgetFormFilterInput(),
      'montant_facture'        => new sfWidgetFormFilterInput(),
      'num_facture'            => new sfWidgetFormFilterInput(),
      'date_commande'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'tissu'                  => new sfWidgetFormFilterInput(),
      'colori'                 => new sfWidgetFormFilterInput(),
      'metrage'                => new sfWidgetFormFilterInput(),
      'piece_categorie'        => new sfWidgetFormFilterInput(),
      'piece'                  => new sfWidgetFormFilterInput(),
      'date_livraison'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'retard_livraison'       => new sfWidgetFormFilterInput(),
      'livre_le'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'fichier'                => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'saison_id'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Saison'), 'column' => 'id')),
      'fournisseur_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Fournisseur'), 'column' => 'id')),
      'commercial_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Commercial'), 'column' => 'id')),
      'client_id'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Client'), 'column' => 'id')),
      'devise_id'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Devise'), 'column' => 'id')),
      'fournisseur_devise_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('DeviseFournisseur'), 'column' => 'id')),
      'commercial_devise_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('DeviseCommercial'), 'column' => 'id')),
      'commission_fournisseur' => new sfValidatorPass(array('required' => false)),
      'commission_commercial'  => new sfValidatorPass(array('required' => false)),
      'facture_id'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Facture'), 'column' => 'id')),
      'commande_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Commande'), 'column' => 'id')),
      'paiement'               => new sfValidatorPass(array('required' => false)),
      'montant_facture'        => new sfValidatorPass(array('required' => false)),
      'num_facture'            => new sfValidatorPass(array('required' => false)),
      'date_commande'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'tissu'                  => new sfValidatorPass(array('required' => false)),
      'colori'                 => new sfValidatorPass(array('required' => false)),
      'metrage'                => new sfValidatorPass(array('required' => false)),
      'piece_categorie'        => new sfValidatorPass(array('required' => false)),
      'piece'                  => new sfValidatorPass(array('required' => false)),
      'date_livraison'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'retard_livraison'       => new sfValidatorPass(array('required' => false)),
      'livre_le'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fichier'                => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('coupe_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Coupe';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'saison_id'              => 'ForeignKey',
      'fournisseur_id'         => 'ForeignKey',
      'commercial_id'          => 'ForeignKey',
      'client_id'              => 'ForeignKey',
      'devise_id'              => 'ForeignKey',
      'fournisseur_devise_id'  => 'ForeignKey',
      'commercial_devise_id'   => 'ForeignKey',
      'commission_fournisseur' => 'Text',
      'commission_commercial'  => 'Text',
      'facture_id'             => 'ForeignKey',
      'commande_id'            => 'ForeignKey',
      'paiement'               => 'Text',
      'montant_facture'        => 'Text',
      'num_facture'            => 'Text',
      'date_commande'          => 'Date',
      'tissu'                  => 'Text',
      'colori'                 => 'Text',
      'metrage'                => 'Text',
      'piece_categorie'        => 'Text',
      'piece'                  => 'Text',
      'date_livraison'         => 'Date',
      'retard_livraison'       => 'Text',
      'livre_le'               => 'Date',
      'fichier'                => 'Text',
    );
  }
}
