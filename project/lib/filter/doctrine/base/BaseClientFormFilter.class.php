<?php

/**
 * Client filter form base class.
 *
 * @package    nathanmode
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseClientFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'raison_sociale'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'telephone'               => new sfWidgetFormFilterInput(),
      'adresse_livraison'       => new sfWidgetFormFilterInput(),
      'code_postal_livraison'   => new sfWidgetFormFilterInput(),
      'ville_livraison'         => new sfWidgetFormFilterInput(),
      'adresse_facturation'     => new sfWidgetFormFilterInput(),
      'code_postal_facturation' => new sfWidgetFormFilterInput(),
      'ville_facturation'       => new sfWidgetFormFilterInput(),
      'condition_paiement'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'raison_sociale'          => new sfValidatorPass(array('required' => false)),
      'telephone'               => new sfValidatorPass(array('required' => false)),
      'adresse_livraison'       => new sfValidatorPass(array('required' => false)),
      'code_postal_livraison'   => new sfValidatorPass(array('required' => false)),
      'ville_livraison'         => new sfValidatorPass(array('required' => false)),
      'adresse_facturation'     => new sfValidatorPass(array('required' => false)),
      'code_postal_facturation' => new sfValidatorPass(array('required' => false)),
      'ville_facturation'       => new sfValidatorPass(array('required' => false)),
      'condition_paiement'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('client_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Client';
  }

  public function getFields()
  {
    return array(
      'id'                      => 'Number',
      'raison_sociale'          => 'Text',
      'telephone'               => 'Text',
      'adresse_livraison'       => 'Text',
      'code_postal_livraison'   => 'Text',
      'ville_livraison'         => 'Text',
      'adresse_facturation'     => 'Text',
      'code_postal_facturation' => 'Text',
      'ville_facturation'       => 'Text',
      'condition_paiement'      => 'Text',
    );
  }
}
