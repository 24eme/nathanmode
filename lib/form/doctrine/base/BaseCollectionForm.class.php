<?php

/**
 * Collection form base class.
 *
 * @method Collection getObject() Returns the current form's model object
 *
 * @package    nathanmode
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCollectionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                        => new sfWidgetFormInputHidden(),
      'saison_id'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Saison'), 'add_empty' => false)),
      'fournisseur_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => false)),
      'commercial_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Commercial'), 'add_empty' => false)),
      'client_id'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Client'), 'add_empty' => false)),
      'devise_fournisseur_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DeviseFournisseur'), 'add_empty' => false)),
      'devise_commercial_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DeviseCommercial'), 'add_empty' => false)),
      'paiement'                  => new sfWidgetFormInputText(),
      'num_commande'              => new sfWidgetFormInputText(),
      'date_commande'             => new sfWidgetFormDate(),
      'fichier'                   => new sfWidgetFormInputText(),
      'situation'                 => new sfWidgetFormInputText(),
      'prix_fournisseur'          => new sfWidgetFormInputText(),
      'prix_commercial'           => new sfWidgetFormInputText(),
      'qualite'                   => new sfWidgetFormInputText(),
      'ecru'                      => new sfWidgetFormInputText(),
      'observation_general'       => new sfWidgetFormInputText(),
      'observation_tirelle'       => new sfWidgetFormInputText(),
      'fiche_client'              => new sfWidgetFormInputText(),
      'fiche_technique'           => new sfWidgetFormInputText(),
      'observation_client'        => new sfWidgetFormInputText(),
      'fichier_confirmation'      => new sfWidgetFormInputText(),
      'date_livraison'            => new sfWidgetFormDate(),
      'adresse_livraison'         => new sfWidgetFormInputText(),
      'reste_a_livrer'            => new sfWidgetFormInputText(),
      'observation_livraison'     => new sfWidgetFormInputText(),
      'commande_soldee'           => new sfWidgetFormInputCheckbox(),
      'tm_date_expedition'        => new sfWidgetFormDate(),
      'tm_refus_test'             => new sfWidgetFormInputText(),
      'tm_validation'             => new sfWidgetFormInputText(),
      'tm_date_expedition_coteco' => new sfWidgetFormDate(),
      'tm_metrage_coteco'         => new sfWidgetFormInputText(),
      'tm_validation_coteco'      => new sfWidgetFormInputText(),
      'tm_observation'            => new sfWidgetFormInputText(),
      'production'                => new sfWidgetFormInputCheckbox(),
      'date_retard'               => new sfWidgetFormDate(),
      'nb_relance'                => new sfWidgetFormInputText(),
      'part_marge'                => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'saison_id'                 => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Saison'))),
      'fournisseur_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'))),
      'commercial_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Commercial'))),
      'client_id'                 => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Client'))),
      'devise_fournisseur_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DeviseFournisseur'))),
      'devise_commercial_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DeviseCommercial'))),
      'paiement'                  => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'num_commande'              => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'date_commande'             => new sfValidatorDate(array('required' => false)),
      'fichier'                   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'situation'                 => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'prix_fournisseur'          => new sfValidatorPass(array('required' => false)),
      'prix_commercial'           => new sfValidatorPass(array('required' => false)),
      'qualite'                   => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'ecru'                      => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'observation_general'       => new sfValidatorPass(array('required' => false)),
      'observation_tirelle'       => new sfValidatorPass(array('required' => false)),
      'fiche_client'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'fiche_technique'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'observation_client'        => new sfValidatorPass(array('required' => false)),
      'fichier_confirmation'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'date_livraison'            => new sfValidatorDate(array('required' => false)),
      'adresse_livraison'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'reste_a_livrer'            => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'observation_livraison'     => new sfValidatorPass(array('required' => false)),
      'commande_soldee'           => new sfValidatorBoolean(array('required' => false)),
      'tm_date_expedition'        => new sfValidatorDate(array('required' => false)),
      'tm_refus_test'             => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'tm_validation'             => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'tm_date_expedition_coteco' => new sfValidatorDate(array('required' => false)),
      'tm_metrage_coteco'         => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'tm_validation_coteco'      => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'tm_observation'            => new sfValidatorPass(array('required' => false)),
      'production'                => new sfValidatorBoolean(array('required' => false)),
      'date_retard'               => new sfValidatorDate(array('required' => false)),
      'nb_relance'                => new sfValidatorInteger(array('required' => false)),
      'part_marge'                => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('collection[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Collection';
  }

}
