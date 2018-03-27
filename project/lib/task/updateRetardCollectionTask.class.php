<?php

class updateRetardCollectionTask extends sfBaseTask {
    

    protected function configure() {
        $this->addArguments(array(
            
        ));

        $this->addOptions(array(
            new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'intranet'),
            new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
            new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
        ));

        $this->namespace = 'collections';
        $this->name = 'update-retards';
        $this->briefDescription = '';
        $this->detailedDescription = <<<EOF
La tâche [factures:update-relation|INFO] met à jour la date de retard (collection|production).

  [php symfony factures:update-retards|INFO]
EOF;
    }

    protected function execute($arguments = array(), $options = array()) {
        $databaseManager = new sfDatabaseManager($this->configuration);
        $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

        $req = "SELECT c.id as id, MAX( r.date ) as date FROM collection c INNER JOIN collection_retard r ON r.collection_id = c.id GROUP BY c.id";
        $result = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($req);
        $i=0;
        foreach ($result as $item) {
        	echo $item['id']."\n";
        	if ($item['date']) {
        		Doctrine_Query::create()->update('Collection c')->set('c.date_retard', '?', $item['date'])->where('c.id = ?', $item['id'])->execute();
        		$i++;
        	}
        }
        $this->logSection($i." Date(s) ajoutée(s)", "updated done", null, 'INFO');
    }

}
