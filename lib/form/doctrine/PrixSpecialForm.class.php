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
  		$this->setWidget('date', new sfWidgetFormInputText());

  		$this->setValidator('date', new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~', 'required' => false)));
  		  
        $this->widgetSchema->setHelp('date', '(jj/mm/aaaa)');
  		$this->embedRelation('PrixSpecialDetails as details');
  }

  public function updateDefaultsFromObject() {
      parent::updateDefaultsFromObject();

      if ($this->getObject()->date) {
        $this->defaults['date'] = $this->getObject()->getDateTimeObject('date')->format('d/m/Y');
      }
  }
}
