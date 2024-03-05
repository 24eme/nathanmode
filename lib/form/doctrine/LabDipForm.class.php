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
  		$this->setWidget('date_envoi', new WidgetFormInputDate());
  		$this->setValidator('date_envoi', new sfValidatorDate(array('required' => false)));
  		$this->setWidget('statut', new sfWidgetFormChoice(array('choices' => $this->getStatuts())));
        $this->setValidator('statut', new sfValidatorChoice(
            array('choices' => array_keys($this->getStatuts()),
                  'required' => $this->getValidator('statut')->getOption('required'),
                )
            ));
  		$this->embedRelation('LabDipDetails as details');
  }
    public function getStatuts() {

        return StatutsLabDip::getListe();
    }
}
