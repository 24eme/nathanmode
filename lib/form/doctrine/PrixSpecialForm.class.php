<?php

/**
 * PrixSpecial form.
 *
 * @package    nathanmode
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PrixSpecialForm extends BasePrixSpecialForm
{
  public function configure()
  {
  		$this->setWidget('date', new WidgetFormInputDate());

  		$this->setValidator('date', new sfValidatorDate(array('required' => false)));

  		$this->embedRelation('PrixSpecialDetails as details');
  }
}
