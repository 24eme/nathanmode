<?php

class dumpCommandeTask extends sfBaseTask {
    

    protected function configure() {
        $this->addArguments(array(
            
        ));

        $this->addOptions(array(
            new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'intranet'),
            new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
            new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
        ));

        $this->namespace = 'dump';
        $this->name = 'commande';
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
        	$this->logSection("Commande coupe ".$coupe->getId(), "dumped", null, 'INFO');
        }
        $details = CollectionDetailTable::getInstance()->findAll();
        foreach ($details as $detail) {
        	$detail->save();
        	$this->logSection("Commande collection ".$detail->getId(), "dumped", null, 'INFO');
        }
        $this->logSection("Dump", "dumped done", null, 'INFO');
    }

}
