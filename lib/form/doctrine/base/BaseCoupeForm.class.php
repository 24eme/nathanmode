<?php

/**
 * Coupe form base class.
 *
 * @method Coupe getObject() Returns the current form's model object
 *
 * @package    nathanmode
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCoupeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'saison_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Saison'), 'add_empty' => false)),
      'fournisseur_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => false)),
      'commercial_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Commercial'), 'add_empty' => false)),
      'client_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Client'), 'add_empty' => false)),
      'devise_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'), 'add_empty' => false)),
      'fournisseur_devise_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DeviseFournisseur'), 'add_empty' => false)),
      'commercial_devise_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DeviseCommercial'), 'add_empty' => false)),
      'commission_fournisseur' => new sfWidgetFormInputText(),
      'commission_commercial'  => new sfWidgetFormInputText(),
      'facture_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Facture'), 'add_empty' => false)),
      'commande_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Commande'), 'add_empty' => false)),
      'paiement'               => new sfWidgetFormInputText(),
      'prix'                   => new sfWidgetFormInputText(),
      'montant_facture'        => new sfWidgetFormInputText(),
      'num_facture'            => new sfWidgetFormInputText(),
      'date_commande'          => new sfWidgetFormDate(),
      'tissu'                  => new sfWidgetFormInputText(),
      'colori'                 => new sfWidgetFormInputText(),
      'metrage'                => new sfWidgetFormInputText(),
      'piece_categorie'        => new sfWidgetFormInputText(),
      'piece'                  => new sfWidgetFormInputText(),
      'date_livraison'         => new sfWidgetFormDate(),
      'retard_livraison'       => new sfWidgetFormInputText(),
      'livre_le'               => new sfWidgetFormDate(),
      'fichier'                => new sfWidgetFormInputText(),
      'situation'              => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'saison_id'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Saison'))),
      'fournisseur_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'))),
      'commercial_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Commercial'))),
      'client_id'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Client'))),
      'devise_id'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'))),
      'fournisseur_devise_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DeviseFournisseur'))),
      'commercial_devise_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DeviseCommercial'))),
      'commission_fournisseur' => new sfValidatorPass(array('required' => false)),
      'commission_commercial'  => new sfValidatorPass(array('required' => false)),
      'facture_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Facture'))),
      'commande_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Commande'))),
      'paiement'               => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'prix'                   => new sfValidatorPass(array('required' => false)),
      'montant_facture'        => new sfValidatorPass(array('required' => false)),
      'num_facture'            => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'date_commande'          => new sfValidatorDate(array('required' => false)),
      'tissu'                  => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'colori'                 => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'metrage'                => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'piece_categorie'        => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'piece'                  => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'date_livraison'         => new sfValidatorDate(array('required' => false)),
      'retard_livraison'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'livre_le'               => new sfValidatorDate(array('required' => false)),
      'fichier'                => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'situation'              => new sfValidatorString(array('max_length' => 128, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('coupe[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Coupe';
  }

}
