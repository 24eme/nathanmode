<?php

/**
 * PrixSpecialDetail filter form base class.
 *
 * @package    nathanmode
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePrixSpecialDetailFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'prix_special_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PrixSpecial'), 'add_empty' => true)),
      'devise_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'), 'add_empty' => true)),
      'prix'            => new sfWidgetFormFilterInput(),
      'quantite'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'prix_special_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('PrixSpecial'), 'column' => 'id')),
      'devise_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Devise'), 'column' => 'id')),
      'prix'            => new sfValidatorPass(array('required' => false)),
      'quantite'        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('prix_special_detail_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PrixSpecialDetail';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'prix_special_id' => 'ForeignKey',
      'devise_id'       => 'ForeignKey',
      'prix'            => 'Text',
      'quantite'        => 'Text',
    );
  }
}
