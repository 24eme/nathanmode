<?php

/**
 * Commande form base class.
 *
 * @method Commande getObject() Returns the current form's model object
 *
 * @package    nathanmode
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCommandeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'saison_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Saison'), 'add_empty' => false)),
      'fournisseur_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => false)),
      'commercial_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Commercial'), 'add_empty' => false)),
      'client_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Client'), 'add_empty' => false)),
      'devise_montant_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DeviseMontant'), 'add_empty' => false)),
      'devise_fournisseur_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DeviseFournisseur'), 'add_empty' => false)),
      'devise_commercial_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DeviseCommercial'), 'add_empty' => false)),
      'prix_fournisseur'      => new sfWidgetFormInputText(),
      'prix_commercial'       => new sfWidgetFormInputText(),
      'total_fournisseur'     => new sfWidgetFormInputText(),
      'total_commercial'      => new sfWidgetFormInputText(),
      'numero'                => new sfWidgetFormInputText(),
      'date'                  => new sfWidgetFormDate(),
      'montant'               => new sfWidgetFormInputText(),
      'colori'                => new sfWidgetFormInputText(),
      'metrage'               => new sfWidgetFormInputText(),
      'piece'                 => new sfWidgetFormInputText(),
      'qualite'               => new sfWidgetFormInputText(),
      'situation'             => new sfWidgetFormInputText(),
      'relation'              => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'saison_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Saison'))),
      'fournisseur_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'))),
      'commercial_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Commercial'))),
      'client_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Client'))),
      'devise_montant_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DeviseMontant'))),
      'devise_fournisseur_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DeviseFournisseur'))),
      'devise_commercial_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DeviseCommercial'))),
      'prix_fournisseur'      => new sfValidatorPass(array('required' => false)),
      'prix_commercial'       => new sfValidatorPass(array('required' => false)),
      'total_fournisseur'     => new sfValidatorPass(array('required' => false)),
      'total_commercial'      => new sfValidatorPass(array('required' => false)),
      'numero'                => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'date'                  => new sfValidatorDate(array('required' => false)),
      'montant'               => new sfValidatorPass(array('required' => false)),
      'colori'                => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'metrage'               => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'piece'                 => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'qualite'               => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'situation'             => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'relation'              => new sfValidatorString(array('max_length' => 50, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('commande[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Commande';
  }

}
