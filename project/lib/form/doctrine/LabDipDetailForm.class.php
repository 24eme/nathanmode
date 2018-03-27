<?php

/**
 * LabDipDetail form.
 *
 * @package    nathanmode
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class LabDipDetailForm extends BaseLabDipDetailForm
{
  public function configure()
  {
        $this->useFields(array('date', 
                               'statut',
                               'reference'));
  		$this->setWidget('date', new sfWidgetFormInputText());

  		$this->setValidator('date', new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~', 'required' => false)));
  		$this->setWidget('statut', new sfWidgetFormChoice(array('choices' => $this->getStatuts())));
        $this->setValidator('statut', new sfValidatorChoice(
            array('choices' => array_keys($this->getStatuts()),
                  'required' => $this->getValidator('statut')->getOption('required'),
                )
            ));
  }

  public function updateDefaultsFromObject() {
      parent::updateDefaultsFromObject();

      if ($this->getObject()->date) {
        $this->defaults['date'] = $this->getObject()->getDateTimeObject('date')->format('d/m/Y');
      }
  }

  public function getStatuts() 
  {
    return Statuts::getListe();
  }
}
