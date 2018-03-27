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
  	$this->setWidget('date_debit', new sfWidgetFormInputText());
  	$this->setValidator('date_debit', new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~', 'required' => false)));
  	$this->setWidget('statut', new sfWidgetFormChoice(array('choices' => $this->getStatuts(), 'multiple' => false)));
  	$this->setValidator('statut', new sfValidatorChoice(array('choices' => array_keys($this->getStatuts()), 'required' => true)));
  	$this->widgetSchema->setHelp('date_debit', '(jj/mm/aaaa)');	  
	$this->getWidgetSchema()->setLabel('date_debit', 'Date de paiement');
  }
    public function getStatuts() {

        return StatutsFacture::getListe();
    }

  public function updateDefaultsFromObject() {
      parent::updateDefaultsFromObject();

      if ($this->getObject()->getDateDebit()) {
        $this->defaults['date_debit'] = $this->getObject()->getDateTimeObject('date_debit')->format('d/m/Y');
      }
  }
}
