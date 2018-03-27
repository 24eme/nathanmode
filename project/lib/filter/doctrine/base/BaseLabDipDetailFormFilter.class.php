<?php

/**
 * LabDipDetail filter form base class.
 *
 * @package    nathanmode
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLabDipDetailFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'lab_dip_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LabDip'), 'add_empty' => true)),
      'date'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'statut'     => new sfWidgetFormFilterInput(),
      'reference'  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'lab_dip_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('LabDip'), 'column' => 'id')),
      'date'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'statut'     => new sfValidatorPass(array('required' => false)),
      'reference'  => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lab_dip_detail_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LabDipDetail';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'lab_dip_id' => 'ForeignKey',
      'date'       => 'Date',
      'statut'     => 'Text',
      'reference'  => 'Text',
    );
  }
}
