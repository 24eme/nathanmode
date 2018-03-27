<?php

/**
 * Fournisseur filter form base class.
 *
 * @package    nathanmode
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFournisseurFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'devise_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'), 'add_empty' => true)),
      'raison_sociale' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'prenom'         => new sfWidgetFormFilterInput(),
      'telephone'      => new sfWidgetFormFilterInput(),
      'adresse'        => new sfWidgetFormFilterInput(),
      'code_postal'    => new sfWidgetFormFilterInput(),
      'ville'          => new sfWidgetFormFilterInput(),
      'commission'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'devise_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Devise'), 'column' => 'id')),
      'raison_sociale' => new sfValidatorPass(array('required' => false)),
      'prenom'         => new sfValidatorPass(array('required' => false)),
      'telephone'      => new sfValidatorPass(array('required' => false)),
      'adresse'        => new sfValidatorPass(array('required' => false)),
      'code_postal'    => new sfValidatorPass(array('required' => false)),
      'ville'          => new sfValidatorPass(array('required' => false)),
      'commission'     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('fournisseur_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Fournisseur';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'devise_id'      => 'ForeignKey',
      'raison_sociale' => 'Text',
      'prenom'         => 'Text',
      'telephone'      => 'Text',
      'adresse'        => 'Text',
      'code_postal'    => 'Text',
      'ville'          => 'Text',
      'commission'     => 'Text',
    );
  }
}
