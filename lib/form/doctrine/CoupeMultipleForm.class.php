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

        $formItem->setWidget('date_demande', new sfWidgetFormInput(array('type' => 'date')));
        $formItem->setValidator('date_demande', new sfValidatorPass());

        $formItem->setWidget('commande', new sfWidgetFormInput());
        $formItem->setValidator('commande', new sfValidatorPass());

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

        $formItem->setWidget('quantite', new sfWidgetFormInput());
        $formItem->setValidator('quantite', new sfValidatorPass());

        $formItem->setWidget('prix', new sfWidgetFormInput());
        $formItem->setValidator('prix', new sfValidatorPass());
        
        $formItem->setWidget('num_facture', new sfWidgetFormInput());
        $formItem->setValidator('num_facture', new sfValidatorPass());

        $formItem->setWidget('fichier', new sfWidgetFormInputFile(array()));
        $formItem->setValidator('fichier', new sfValidatorFile(array('required' => false, 'path' => FactureTable::getInstance()->getUploadPath(true))));

        $formItem->setWidget('situation', new sfWidgetFormChoice(array('choices' => array_merge(array("" => "Select an option"), CoupeForm::getSituations()))));
        $formItem->setValidator('situation', new sfValidatorChoice(array('choices' => array_keys(CoupeForm::getSituations()), 'required' => false)));
 
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
            if(!isset($itemValues['colori']) || !$itemValues['colori']) {
                continue;
            }
            
            $coupe = new Coupe();
            $coupe->setSaisonId($itemValues['saison_id']);
            $coupe->setCommercialId($itemValues['commercial_id']);
            $coupe->setCommercialDeviseId(Devise::POURCENTAGE_ID);
            $coupe->setFournisseurId($itemValues['fournisseur_id']);
            $coupe->setFournisseurDeviseId(Devise::POURCENTAGE_ID);
            $coupe->setDateCommande($itemValues['date_demande']);
            $coupe->setClientId($itemValues['client_id']);
            $coupe->setQualite($itemValues['qualite']);
            $coupe->setColori($itemValues['colori']);
            if($itemValues['quantite_type'] == "METRAGE") {
                $coupe->setMetrage($itemValues['quantite']);
            } else {
                $coupe->setPiece($itemValues['quantite']);
                $coupe->setPieceCategorie($itemValues['quantite_type']);
            }
            $coupe->setPrix($itemValues['prix']*1);
            $coupe->setDeviseId(Devise::EUROS_ID);
            $coupe->setSituation($itemValues['situation']);
            $coupe->setNumFacture($itemValues['num_facture']);

            if($itemValues['fichier']) {
                $coupe->setFichier($itemValues['fichier']->generateFilename());
                $itemValues['fichier']->save($coupe->getFichier());
            }

            $coupe->save();
        }
    }

}
