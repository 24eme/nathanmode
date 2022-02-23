<?php

/**
 * Commercial filter form base class.
 *
 * @package    nathanmode
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCommercialFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'devise_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'), 'add_empty' => true)),
      'nom'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'prenom'     => new sfWidgetFormFilterInput(),
      'email'      => new sfWidgetFormFilterInput(),
      'telephone'  => new sfWidgetFormFilterInput(),
      'commission' => new sfWidgetFormFilterInput(),
      'is_super_commercial'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'devise_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Devise'), 'column' => 'id')),
      'nom'        => new sfValidatorPass(array('required' => false)),
      'prenom'     => new sfValidatorPass(array('required' => false)),
      'email'      => new sfValidatorPass(array('required' => false)),
      'telephone'  => new sfValidatorPass(array('required' => false)),
      'commission' => new sfValidatorPass(array('required' => false)),
      'is_super_commercial'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('commercial_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Commercial';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'devise_id'  => 'ForeignKey',
      'nom'        => 'Text',
      'prenom'     => 'Text',
      'email'      => 'Text',
      'telephone'  => 'Text',
      'commission' => 'Text',
      'is_super_commercial'   => 'Boolean',
    );
  }
}
