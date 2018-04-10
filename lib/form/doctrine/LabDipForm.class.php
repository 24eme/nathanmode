<?php

/**
 * LabDip form.
 *
 * @package    nathanmode
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class LabDipForm extends BaseLabDipForm
{
  public function configure()
  {
  		$this->setWidget('date_envoi', new sfWidgetFormInputText());
  		$this->setValidator('date_envoi', new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~', 'required' => false)));
  		$this->setWidget('statut', new sfWidgetFormChoice(array('choices' => $this->getStatuts())));
        $this->setValidator('statut', new sfValidatorChoice(
            array('choices' => array_keys($this->getStatuts()),
                  'required' => $this->getValidator('statut')->getOption('required'),
                )
            ));
  		$this->widgetSchema->setHelp('date_envoi', '(jj/mm/aaaa)');
  		$this->embedRelation('LabDipDetails as details');
  }
    public function getStatuts() {

        return StatutsLabDip::getListe();
    }

  public function updateDefaultsFromObject() {
      parent::updateDefaultsFromObject();

      if ($this->getObject()->date_envoi) {
        $this->defaults['date_envoi'] = $this->getObject()->getDateTimeObject('date_envoi')->format('d/m/Y');
      }
  }
}
