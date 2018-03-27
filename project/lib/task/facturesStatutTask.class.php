<?php

class facturesStatutTask extends sfBaseTask {
    

    protected function configure() {
        $this->addArguments(array(
            
        ));

        $this->addOptions(array(
            new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'intranet'),
            new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
            new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
        ));

        $this->namespace = 'factures';
        $this->name = 'statut';
        $this->briefDescription = '';
        $this->detailedDescription = <<<EOF
La tâche [factures:statut|INFO] met à jour le statut d'une facture (en attente -> echue) si la date de ladite est inférieur ou égale à la date du jour.

  [php symfony factures:statut|INFO]
EOF;
    }

    protected function execute($arguments = array(), $options = array()) {
        $databaseManager = new sfDatabaseManager($this->configuration);
        $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

        $factures = FactureTable::getInstance()->findEnAttente();
        $i=0;
        foreach ($factures as $facture) {
        	if ($facture->getEcheance()) {
        		if (str_replace('-', '', $facture->getEcheance()) <= date('Ymd')) {
        			$facture->setStatut(StatutsBon::STATUT_ECHUE);
        			$facture->save();
        			$this->logSection("Facture ".$facture->getId().' : statut mis à jour pour ECHUE', "updated", null, 'INFO');
        			$i++;
        		}
        	} else  {
        		$facture->setStatut(StatutsBon::STATUT_ERREUR);
        		$facture->save();
        		$this->logSection("Facture ".$facture->getId().' : statut mis à jour pour ERREUR', "updated", null, 'INFO');
        		$i++;
        	}
        }
        $this->logSection($i." Facture(s) modifiées", "updated done", null, 'INFO');
    }

}
