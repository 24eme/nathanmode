<?php

class CoupeMultipleForm extends BaseForm
{
    public function configure()
    {
        $formCollection = new BaseForm();
        $formCollection->embedForm(0, $this->createFormItem());
        $this->embedForm('coupes', $formCollection);

        $this->widgetSchema->setNameFormat('coupe_multiple[%s]');
    }

    public function createFormItem() {
        $formItem = new BaseForm();
        $formItem->setWidget('saison_id', new sfWidgetFormDoctrineChoice(array('model' =>
        'Saison', 'add_empty' => true)));
        $formItem->setValidator('saison_id', new sfValidatorDoctrineChoice(array('model' => 'Saison', 'required' => false)));

        $formItem->setWidget('commercial_id', new sfWidgetFormDoctrineChoice(array('model' =>
        'Commercial', 'add_empty' => true)));
        $formItem->setValidator('commercial_id', new sfValidatorDoctrineChoice(array('model' => 'Commercial', 'required' => false)));

        $formItem->setWidget('date_commande', new sfWidgetFormInput(array('type' => 'date')));
        $formItem->setValidator('date_commande', new sfValidatorPass());
        $formItem->setDefault('date_commande', date('Y-m-d'));

        $formItem->setWidget('livre_le', new sfWidgetFormInput(array('type' => 'date')));
        $formItem->setValidator('livre_le', new sfValidatorPass());

        $formItem->setWidget('fournisseur_id', new sfWidgetFormDoctrineChoice(array('model' =>
        'Fournisseur', 'add_empty' => true)));
        $formItem->setValidator('fournisseur_id', new sfValidatorDoctrineChoice(array('model' => 'Fournisseur', 'required' => false)));

        $formItem->setWidget('client_id', new sfWidgetFormDoctrineChoice(array('model' =>
        'Client', 'add_empty' => true)));
        $formItem->setValidator('client_id', new sfValidatorDoctrineChoice(array('model' => 'Client', 'required' => false)));

        $formItem->setWidget('qualite', new sfWidgetFormInput());
        $formItem->setValidator('qualite', new sfValidatorPass());

        $formItem->setWidget('colori', new sfWidgetFormInput());
        $formItem->setValidator('colori', new sfValidatorPass());

        $formItem->setWidget('quantite_type', new sfWidgetFormChoice(array('choices' => CoupeForm::getQuantiteType())));
        $formItem->setValidator('quantite_type', new sfValidatorChoice(array('choices' => array_keys(CoupeForm::getQuantiteType()), 'required' => false)));

        $formItem->setWidget('quantite', new sfWidgetFormInput(array(), array('autocomplete' => 'off')));
        $formItem->setValidator('quantite', new sfValidatorNumber(array('required' => false)));

        $formItem->setWidget('prix', new sfWidgetFormInput(array(), array('autocomplete' => 'off')));
        $formItem->setValidator('prix', new sfValidatorNumber(array('required' => false)));

        $formItem->setWidget('num_facture', new sfWidgetFormInput(array(), array('autocomplete' => 'off')));
        $formItem->setValidator('num_facture', new sfValidatorPass());

        $formItem->setWidget('fichier', new sfWidgetFormInputFile(array()));
        $formItem->setValidator('fichier', new sfValidatorFile(array('required' => false, 'path' => FactureTable::getInstance()->getUploadPath(true))));

        $formItem->setWidget('fichier_confirmation', new sfWidgetFormInputFile(array()));
        $formItem->setValidator('fichier_confirmation', new sfValidatorFile(array('required' => false, 'path' => CoupeTable::getInstance()->getUploadPath(true))));

        return $formItem;
    }

    public function bind(array $taintedValues = null, array $taintedFiles = null)
    {
        $formCollection = new BaseForm();
        foreach($taintedValues['coupes'] as $key => $itemValues) {
            $formCollection->embedForm($key, $this->createFormItem());
        }
        $this->embedForm('coupes', $formCollection);

        return parent::bind($taintedValues, $taintedFiles);
    }

    public function save() {
        $values = $this->getValues();
        $collections = array();
        foreach($values['coupes'] as $itemValues) {
            if(!isset($itemValues['quantite']) || !$itemValues['quantite']) {
                continue;
            }

            $coupe = new Coupe();
            $coupe->setSaisonId($itemValues['saison_id']);
            $coupe->setCommercialId($itemValues['commercial_id']);
            if ($commercial = CommercialTable::getInstance()->find($itemValues['commercial_id'])) {
              $coupe->setCommissionCommercial($commercial->getCommission());
              $coupe->setCommercialDeviseId($commercial->getDeviseId());
              $coupe->setDeviseCommercial($commercial->getDevise());
            } else {
              $coupe->setCommercialDeviseId(Devise::POURCENTAGE_ID);
            }
            $coupe->setFournisseurId($itemValues['fournisseur_id']);
            if ($fournisseur = FournisseurTable::getInstance()->find($itemValues['fournisseur_id'])) {
              $coupe->setCommissionFournisseur($fournisseur->getCommission());
              $coupe->setFournisseurDeviseId($fournisseur->getDeviseId());
              $coupe->setDeviseFournisseur($fournisseur->getDevise());
            } else {
              $coupe->setFournisseurDeviseId(Devise::POURCENTAGE_ID);
            }
            $coupe->setDateCommande($itemValues['date_commande']);
            if($itemValues['livre_le']) {
                $coupe->setLivreLe($itemValues['livre_le']);
            }
            $coupe->setClientId($itemValues['client_id']);
            if ($client = ClientTable::getInstance()->find($itemValues['client_id'])) {
              $coupe->setPaiement($client->getConditionPaiement());
            }
            $coupe->setQualite(trim($itemValues['qualite']));
            $coupe->setColori($itemValues['colori']);
            if($itemValues['quantite_type'] == "METRAGE") {
                $coupe->setMetrage($itemValues['quantite']);
            } else {
                $coupe->setPiece($itemValues['quantite']);
                $coupe->setPieceCategorie($itemValues['quantite_type']);
            }
            $coupe->setPrix($itemValues['prix']);
            $coupe->setDeviseId(Devise::EUROS_ID);
            $coupe->setNumFacture($itemValues['num_facture']);

            if($itemValues['fichier']) {
                $coupe->setFichier($itemValues['fichier']->generateFilename());
                $itemValues['fichier']->save($coupe->getFichier());
              }

              if($itemValues['fichier_confirmation']) {
                  $coupe->setFichierConfirmation($itemValues['fichier_confirmation']->generateFilename());
                  $itemValues['fichier_confirmation']->save($coupe->getFichierConfirmation());
              }

            $coupe->save();
        }
    }

}
