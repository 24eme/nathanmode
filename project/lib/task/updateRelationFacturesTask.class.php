<?php

class updateRelationFacturesTask extends sfBaseTask {
    

    protected function configure() {
        $this->addArguments(array(
            
        ));

        $this->addOptions(array(
            new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'intranet'),
            new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
            new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
        ));

        $this->namespace = 'factures';
        $this->name = 'update-relation';
        $this->briefDescription = '';
        $this->detailedDescription = <<<EOF
La tâche [factures:update-relation|INFO] met à jour la relation (collection|production) d'une facture (update global suite a un bug applicatif).

  [php symfony factures:update-relation|INFO]
EOF;
    }

    protected function execute($arguments = array(), $options = array()) {
        $databaseManager = new sfDatabaseManager($this->configuration);
        $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

        $collectionLivraisons = CollectionLivraisonTable::getInstance()->getAll();
        $i=0;
        foreach ($collectionLivraisons as $collectionLivraison) {
        	if ($facture = $collectionLivraison->getFacture()) {
        		
        		if ($collectionLivraison->getCollection()->getProduction() && $facture->getRelation() != Facture::TYPE_PRODUCTION) {
			    	$facture->setRelation(Facture::TYPE_PRODUCTION);
			    	$facture->save();
			    	$i++;
        		} elseif (!$collectionLivraison->getCollection()->getProduction() && $facture->getRelation() != Facture::TYPE_COLLECTION) {
			    	$facture->setRelation(Facture::TYPE_COLLECTION);
			    	$facture->save();
        			$i++;
        		}
        	}
        }
        $this->logSection($i." Facture(s) corrigée(s)", "updated done", null, 'INFO');
    }

}
