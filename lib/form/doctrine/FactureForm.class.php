<?php

/**
 * Facture form.
 *
 * @package    nathanmode
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FactureForm extends BaseFactureForm
{
  /**
   * @see BonForm
   */
  public function configure()
  {
    parent::configure();
    $this->useFields(array('date_debit', 'statut'));
  	$this->setWidget('date_debit', new WidgetFormInputDate());
  	$this->setValidator('date_debit', new sfValidatorDate(array('required' => false)));
  	$this->setWidget('statut', new sfWidgetFormChoice(array('choices' => $this->getStatuts(), 'multiple' => false)));
  	$this->setValidator('statut', new sfValidatorChoice(array('choices' => array_keys($this->getStatuts()), 'required' => true)));
	$this->getWidgetSchema()->setLabel('date_debit', 'Date de paiement');
  }
    public function getStatuts() {

        return StatutsFacture::getListe();
    }
}
