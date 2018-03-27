<?php

class dumpFactureTask extends sfBaseTask {
    

    protected function configure() {
        $this->addArguments(array(
            
        ));

        $this->addOptions(array(
            new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'intranet'),
            new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
            new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
        ));

        $this->namespace = 'dump';
        $this->name = 'facture';
        $this->briefDescription = '';
        $this->detailedDescription = <<<EOF
The [dump|INFO] task does things.
Call it with:

  [php symfony dump|INFO]
EOF;
    }

    protected function execute($arguments = array(), $options = array()) {
        $databaseManager = new sfDatabaseManager($this->configuration);
        $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

        $coupes = CoupeTable::getInstance()->findAll();
        foreach ($coupes as $coupe) {
        	$coupe->save();
        	$this->logSection("Facture coupe ".$coupe->getId(), "dumped", null, 'INFO');
        }
        $livraisons = CollectionLivraisonTable::getInstance()->findAll();
        foreach ($livraisons as $livraison) {
        	$livraison->save();
        	$this->logSection("Facture livraison ".$livraison->getId(), "dumped", null, 'INFO');
        }
        $this->logSection("Dump", "dumped done", null, 'INFO');
    }

}
