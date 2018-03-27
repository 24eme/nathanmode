<?php

/**
 * PrixSpecial filter form.
 *
 * @package    nathanmode
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PrixSpecialFormFilter extends BasePrixSpecialFormFilter
{
  public function configure()
  {
  	$this->setWidget('details', new WidgetFormInputDisabled());
  	$this->setValidator('details', new sfValidatorPass(array('required' => false)));
  	$this->getWidget('article')->setOption('with_empty', false);
  	$this->getWidget('prix_production')->setOption('with_empty', false);
  	$this->getWidget('date')->setOption('with_empty', false);
  }
}
