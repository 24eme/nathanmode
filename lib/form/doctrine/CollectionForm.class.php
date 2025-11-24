<?php

/**
 * Collection form.
 *
 * @package    nathanmode
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CollectionForm extends BaseCollectionForm
{
    
    public function configure() {
        $this->useFields(array(
                       //Infos Generales
                       'saison_id',
                       'fournisseur_id',
                       'commercial_id',
                       'client_id',
                       'paiement',
                       'num_commande',
                       'date_commande',
                       'fichier',
                       'situation',
                       'prix_fournisseur',
                       'part_marge',
                       'devise_fournisseur_id',
                       'ecru',
                       'observation_general',

                       //Tirelles
                       'observation_tirelle',

                       //Fiche client
                       'fiche_client',
                       'fiche_technique',
                       'observation_client',

                       //Test Matière
                       'tm_date_expedition',
                       'tm_refus_test',
                       'tm_validation',
                       'tm_date_expedition_coteco',
                       'tm_metrage_coteco',
                       'tm_validation_coteco',
                       'tm_observation',

                       //Livraisons
                       'fichier_confirmation',
                       'date_livraison',
                       'adresse_livraison',
                       'reste_a_livrer',
                       'observation_livraison',
                       'commande_soldee',
                       ));

        $this->embedRelation('CollectionDetails as details');
        if (!sfConfig::get('app_no_metrage')) {
          $this->embedRelation('CollectionTirelles as tirelles');
        }
        $this->embedRelation('CollectionRetards as retards');
        $this->embedRelation('CollectionLivraisons as livraisons');

        $this->setWidget('paiement', new sfWidgetFormChoice(array('choices' => $this->getPaiements())));
        $this->setValidator('paiement', new sfValidatorChoice(
            array('choices' => array_keys($this->getPaiements()),
                  'required' => true,
                )
            ));

        $this->setWidget('situation', new sfWidgetFormChoice(array('choices' => $this->getSituations())));
        $this->setValidator('situation', new sfValidatorChoice(
            array('choices' => array_keys($this->getSituations()),
                  'required' => $this->getValidator('situation')->getOption('required'),
                )
            ));

        $this->setWidget('fichier', new sfWidgetFormInputFileEditable(array(
                                                                      'file_src' => CollectionTable::getInstance()->getUploadPath(false).$this->getObject()->fichier,
                                                                       'edit_mode' => $this->getObject()->fichier,
                                                                       'template' => '%input%<br />%delete% Suppr. le fichier<a href="%file%" target="_blank">Voir le fichier</a>'
                                                                    )));
        $this->setValidator('fichier', new sfValidatorFile(
            array('required' => $this->getValidator('fichier')->getOption('required'),
                  'path' => CollectionTable::getInstance()->getUploadPath(true))
            ));

        $this->setWidget('fiche_client', new sfWidgetFormInputFileEditable(array(
                                                                      'file_src' => CollectionTable::getInstance()->getUploadPath(false).$this->getObject()->fiche_client,
                                                                       'edit_mode' => $this->getObject()->fiche_client,
                                                                       'template' => '%input%<br />%delete% Suppr. le fichier<a href="%file%" target="_blank">Voir le fichier</a>'
                                                                    )));
        $this->setValidator('fiche_client', new sfValidatorFile(
            array('required' => $this->getValidator('fiche_client')->getOption('required'),
                  'path' => CollectionTable::getInstance()->getUploadPath(true))
            ));

        $this->setWidget('fiche_technique', new sfWidgetFormInputFileEditable(array(
                                                                      'file_src' => CollectionTable::getInstance()->getUploadPath(false).$this->getObject()->fiche_technique,
                                                                       'edit_mode' => $this->getObject()->fiche_technique,
                                                                       'template' => '%input%<br />%delete% Suppr. le fichier<a href="%file%" target="_blank">Voir le fichier</a>'
                                                                    )));
        $this->setValidator('fiche_technique', new sfValidatorFile(
            array('required' => $this->getValidator('fiche_technique')->getOption('required'),
                  'path' => CollectionTable::getInstance()->getUploadPath(true))
            ));

        $this->setWidget('fichier_confirmation', new sfWidgetFormInputFileEditable(array(
                                                                      'file_src' => CollectionTable::getInstance()->getUploadPath(false).$this->getObject()->fichier_confirmation,
                                                                       'edit_mode' => $this->getObject()->fichier_confirmation,
                                                                       'template' => '%input%<br />%delete% Suppr. le fichier<a href="%file%" target="_blank">Voir le fichier</a>'
                                                                    )));
        $this->setValidator('fichier_confirmation', new sfValidatorFile(
            array('required' => $this->getValidator('fichier_confirmation')->getOption('required'),
                  'path' => CollectionTable::getInstance()->getUploadPath(true))
            ));

        $this->setWidget('date_commande', new WidgetFormInputDate());
        $this->setValidator('date_commande', new sfValidatorDate(array('required' => true)));

        $this->setWidget('date_livraison', new WidgetFormInputDate());
        $this->setValidator('date_livraison', new sfValidatorDate(array('required' => false)));

        $this->setWidget('tm_date_expedition', new WidgetFormInputDate());
        $this->setValidator('tm_date_expedition', new sfValidatorDate(array('required' => false)));

        $this->setWidget('tm_date_expedition_coteco', new WidgetFormInputDate());
        $this->setValidator('tm_date_expedition_coteco', new sfValidatorDate(array('required' => false)));

        $this->setWidget('observation_general', new sfWidgetFormTextarea());
        $this->setWidget('observation_tirelle', new sfWidgetFormTextarea());
        $this->setWidget('observation_client', new sfWidgetFormTextarea());
        $this->setWidget('observation_livraison', new sfWidgetFormTextarea());
        $this->setWidget('tm_observation', new sfWidgetFormTextarea());

        $this->setValidator('fichier_delete', new sfValidatorPass());
        $this->setValidator('fiche_client_delete', new sfValidatorPass());
        $this->setValidator('fiche_technique_delete', new sfValidatorPass());
        $this->setValidator('fichier_confirmation_delete', new sfValidatorPass());

        $this->setWidget('saison_id', new sfWidgetFormChoice(array('choices' => $this->getSaisons())));

        $this->setWidget('devise_id', new sfWidgetFormDoctrineChoice(array('model' => 'Devise', 'add_empty' => false)));
        $this->setValidator('devise_id', new sfValidatorDoctrineChoice(array('model' => 'Devise')));

        $this->getWidgetSchema()->setLabels(array(
           //Infos Generales
           'saison_id' => 'Saison',
           'fournisseur_id' => 'Fournisseur',
           'commercial_id' => 'Commercial',
           'client_id' => 'Client',
           'paiement' => 'Conditions paiement',
           'num_commande' => 'Commande n°',
           'date_commande' => 'Date commande',
           'fichier' => 'Doc de commande',
           'situation' => 'Situation',
           'prix_fournisseur' => 'Commission',
           'devise_fournisseur_id' => 'Devise de la commission',
           'piece_categorie' => 'Catégorie',
           'ecru' => 'Ecru à désigner',
           'observation_general' => 'Observation',

           //Tirelles
           'observation_tirelle' => 'Observation',

           //Fiche client
           'fiche_client' => 'Joindre fiche client',
           'fiche_technique' => 'Joindre fiche technique',
           'observation_client' => 'Observation',

           //Test Matière
           'tm_date_expedition' => "Date d'expédition",
           'tm_refus_test' => 'Refus test',
           'tm_validation' => 'Validation',
           'tm_date_expedition_coteco' => 'Date exp COTECO',
           'tm_metrage_coteco' => 'Métrage COTECO',
           'tm_validation_coteco' => 'Validation COTECO',
           'tm_observation' => 'Observation',

           //Livraisons
           'fichier_confirmation' => 'Confirmation',
           'date_livraison' => 'Date de livraison',
           'adresse_livraison' => 'Adresse de livraison',
           'reste_a_livrer' => 'Reste à livrer',
           'observation_livraison' => 'Observation',
           'commande_soldee' => 'Commande soldée',

           'part_marge' => 'Part de marge',
        ));

        $this->getWidget('reste_a_livrer')->setAttribute('readonly', 'readonly');

        $this->getValidator('saison_id')->setOption('required', true);
        $this->getValidator('fournisseur_id')->setOption('required', true);
        $this->getValidator('client_id')->setOption('required', true);
        $this->getValidator('num_commande')->setOption('required', true);
        $this->getValidator('prix_fournisseur')->setOption('required', true);

        $this->getWidget('prix_fournisseur')->setAttribute('class', 'input-float');

        $this->setWidget('usd_rate', new sfWidgetFormInputHidden());
        $this->setValidator('usd_rate', new sfValidatorPass(array('required' => false)));
        $this->setWidget('eur_rate', new sfWidgetFormInputHidden());
        $this->setValidator('eur_rate', new sfValidatorPass(array('required' => false)));

        if(sfConfig::get('app_no_metrage')) {
            unset($this['ecru']);
        }

        if($this->getObject()->isCalculCommissionFromMarge() && $this->getObject()->getPrixFournisseur() === null) {
            unset($this['prix_fournisseur']);
        }
        if(!$this->getObject()->isCalculCommissionFromMarge()) {
            unset($this['part_marge']);
        }
    }

    public function updateDefaultsFromObject() {
      parent::updateDefaultsFromObject();

      if (!$this->getObject()->saison_id) {
        $this->defaults['saison_id'] = SaisonTable::getInstance()->getIgByLibelle('ETE '.date('Y'));
      }
      foreach ($this->getObject()->getCollectionDetails() as $detail) {
        $this->defaults['devise_id'] = $detail->getDeviseId();
      }
      $this->defaults['usd_rate'] = Change::getInstance()->getUSDRate();
      $this->defaults['eur_rate'] = Change::getInstance()->getEURRate();
    }

    public function getPaiements() {

        return ConditionsPaiement::getListe();
    }

    public function getSituations() {

      return Situations::getListe();
    }

    public function getSaisons() {
        return SaisonTable::getInstance()->getListeTriee();
    }

    public function bind(array $taintedValues = null, array $taintedFiles = null)
    {
        foreach ($taintedValues['details'] as $key => $detail) {
          $taintedValues['details'][$key]['devise_id'] = $taintedValues['devise_id'];
        }
        if(isset($taintedValues['livraisons'])) {
        foreach ($taintedValues['livraisons'] as $key => $livraison) {
          $taintedValues['livraisons'][$key]['devise_id'] = $taintedValues['devise_id'];
        }
        }
        parent::bind($taintedValues, $taintedFiles);
    }

    public function doUpdateObject($values) {
        $nbRetardPrev = count($this->getObject()->getCollectionRetards());
        parent::doUpdateObject($values);
		    $nbRetardAfter = count($this->getObject()->getCollectionRetards());

        if ($nbRetardAfter > $nbRetardPrev) {
          $this->getObject()->nb_relance = 0;
        }

        if (!$this->getObject()->devise_commercial_id) {
            $this->getObject()->devise_commercial_id = Devise::POURCENTAGE_ID;
        }

        $quantiteEntree = 0;
        $marge = 0;
        if(is_array($values['details'])) {
	        foreach ($values['details'] as $detail) {
            if (isset($detail['metrage'])) {
	        	    $quantiteEntree += $detail['metrage'];
            }
            $marge = round((100 - ($detail['prix_achat'] * 100 / $detail['prix']) * $values['part_marge'] / 100), 2);
	        }
        }
        $quantiteSortie = 0;
        if (is_array($values['livraisons'])) {
	        foreach ($values['livraisons'] as $livraison) {
            if (isset($livraison['metrage'])) {
	        	    $quantiteSortie += $livraison['metrage'];
            }
	        }
        }
        $resteALivrer = $quantiteEntree - $quantiteSortie;
        $this->getObject()->setResteALivrer($resteALivrer);
        if($this->getObject()->getPartMarge()) {
            $this->getObject()->setPrixFournisseur($marge);
        }
    }
}
