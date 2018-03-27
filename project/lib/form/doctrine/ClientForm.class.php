<?php

/**
 * Client form.
 *
 * @package    nathanmode
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ClientForm extends BaseClientForm
{
  public function configure()
  {
  	$this->setWidget('condition_paiement', new sfWidgetFormChoice(array('choices' => $this->getConditionsPaiement())));
    $this->setValidator('condition_paiement', new sfValidatorChoice(
            array('choices' => array_keys($this->getConditionsPaiement()),
                  'required' => $this->getValidator('condition_paiement')->getOption('required'),
                )
            ));
  }

  public function getConditionsPaiement() {

    return ConditionsPaiement::getListe();
  }
}
