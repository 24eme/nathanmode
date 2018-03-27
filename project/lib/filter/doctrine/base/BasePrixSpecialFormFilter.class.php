<?php

/**
 * PrixSpecial filter form base class.
 *
 * @package    nathanmode
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePrixSpecialFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'saison_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Saison'), 'add_empty' => true)),
      'fournisseur_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
      'client_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Client'), 'add_empty' => true)),
      'article'         => new sfWidgetFormFilterInput(),
      'prix_production' => new sfWidgetFormFilterInput(),
      'date'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'saison_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Saison'), 'column' => 'id')),
      'fournisseur_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Fournisseur'), 'column' => 'id')),
      'client_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Client'), 'column' => 'id')),
      'article'         => new sfValidatorPass(array('required' => false)),
      'prix_production' => new sfValidatorPass(array('required' => false)),
      'date'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('prix_special_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PrixSpecial';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'saison_id'       => 'ForeignKey',
      'fournisseur_id'  => 'ForeignKey',
      'client_id'       => 'ForeignKey',
      'article'         => 'Text',
      'prix_production' => 'Text',
      'date'            => 'Date',
    );
  }
}
