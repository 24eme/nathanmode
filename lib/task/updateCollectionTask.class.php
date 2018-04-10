<?php

class updateCollectionTask extends sfBaseTask {
    

    protected function configure() {
        $this->addArguments(array(
            
        ));

        $this->addOptions(array(
            new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'intranet'),
            new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
            new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
        ));

        $this->namespace = 'collections';
        $this->name = 'update-details';
        $this->briefDescription = '';
        $this->detailedDescription = <<<EOF
La tâche [factures:update-relation|INFO] met à jour les details (collection|production).

  [php symfony collections:update|INFO]
EOF;
    }

    protected function execute($arguments = array(), $options = array()) {
    	ini_set('memory_limit', '2048M');
        $databaseManager = new sfDatabaseManager($this->configuration);
        $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

        $collections = CollectionDetailTable::getInstance()->getAll();
        $i=0;
        foreach ($collections as $collection) {
        	$collection->save();
        	$i++;
        	$this->logSection($collection->id." Collection mise à jour", "updated done", null, 'INFO');
        }
        $this->logSection($i." Facture(s) corrigée(s)", "updated done", null, 'INFO');
    }

}
