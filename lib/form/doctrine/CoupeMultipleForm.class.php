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
        
        $formItem->setWidget('metrage', new sfWidgetFormInput());
        $formItem->setValidator('metrage', new sfValidatorPass());
        
        $formItem->setWidget('prix', new sfWidgetFormInput());
        $formItem->setValidator('prix', new sfValidatorPass());
        
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
            $key = $itemValues['saison_id'].'_'.$itemValues['fournisseur_id'].'_'.$itemValues['client_id'];
            if(!isset($collections[$key])) {
                $collection = new Collection();
                $collection->setSaisonId($itemValues['saison_id']);
                $collection->setCommercialId($itemValues['commercial_id']);
                $collection->setDeviseCommercialId(3);
                $collection->setFournisseurId($itemValues['fournisseur_id']);
                $collection->setDeviseFournisseurId(3);
                $collection->setClientId($itemValues['client_id']);
                $collection->setQualite($itemValues['qualite']);
                $collection->setSituation(Situations::SITUATION_ATT_CONFIRMATION);
                $collection->setProduction(0);
                $collection->save();
                $collections[$key] = $collection;
            }
            
            $collectionDetail = new CollectionDetail();
            $collectionDetail->setCollectionId($collection->getId());
            $collectionDetail->setColori($itemValues['colori']);
            $collectionDetail->setMetrage($itemValues['metrage']);
            $collectionDetail->setPrix($itemValues['prix']*1);
            $collectionDetail->setDeviseId(1);
            $collectionDetail->save();
        }
    }
}
