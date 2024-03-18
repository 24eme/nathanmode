<?php

/**
 * Credit form.
 *
 * @package    nathanmode
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CreditForm extends BaseCreditForm
{
  /**
   * @see BonForm
   */
  public function configure()
  {
    parent::configure();
    $this->useFields(array('saison_id', 'fournisseur_id', 'commercial_id', 'client_id', 'montant', 'numero', 'date', 'prix_fournisseur', 'devise_montant_id', 'devise_fournisseur_id', 'prix_commercial', 'devise_commercial_id', 'statut', 'date_debit', 'fichier'));
  		$this->setWidget('fichier', new sfWidgetFormInputFileEditable(array(
                                                                      'file_src' => FactureTable::getInstance()->getUploadPath(false).$this->getObject()->fichier,
                                                                       'edit_mode' => $this->getObject()->fichier,
                                                                       'template' => '<a href="%file%" target="_blank">Télécharger le fichier</a><br />%input%<br />%delete% %delete_label%'
                                                                    )));

      $this->setValidator('fichier', new sfValidatorFile(array('required' => false,
                                                               'path' => FactureTable::getInstance()->getUploadPath(true))));
      $this->setValidator('fichier_delete', new sfValidatorPass());

      $this->setWidget('date', new sfWidgetFormInputText());
      $this->setWidget('date_debit', new sfWidgetFormInputText());
      $this->setValidator('date', new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~', 'required' => false)));
      $this->setValidator('date_debit', new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~', 'required' => false)));
      $this->setWidget('statut', new sfWidgetFormChoice(array('choices' => $this->getStatuts(), 'multiple' => false)));
  	  $this->setValidator('statut', new sfValidatorChoice(array('choices' => array_keys($this->getStatuts()), 'required' => true)));
      
      $this->getWidget('montant')->setAttribute('class', 'input-float');
      $this->getWidget('prix_fournisseur')->setAttribute('class', 'input-float');
      $this->getWidget('prix_commercial')->setAttribute('class', 'input-float');
  }


    public function getStatuts() {

        return StatutsCredit::getListe();
    }
  public function updateDefaultsFromObject() {
      parent::updateDefaultsFromObject();

      if ($this->getObject()->date) {
        $this->defaults['date'] = $this->getObject()->getDateTimeObject('date')->format('d/m/Y');
      }

      if ($this->getObject()->date_debit) {
        $this->defaults['date_debit'] = $this->getObject()->getDateTimeObject('date_debit')->format('d/m/Y');
      }
    }
}
