<?php

class commercialActivityLogTask extends sfBaseTask {


    protected function configure() {

        $this->addOptions(array(
            new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'intranet'),
            new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'prod'),
            new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
        ));

        $this->namespace = 'commercial-activity';
        $this->name = 'log';
        $this->briefDescription = '';
        $this->detailedDescription = <<<EOF
La tâche [commercial-activity:log|INFO] Log les indicateurs du commercial activity à chaque appel de la tâche

  [php symfony commercial-activity:log|INFO]
EOF;
    }

    protected function execute($arguments = array(), $options = array()) {
        $databaseManager = new sfDatabaseManager($this->configuration);
        $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

        $devise = sfConfig::get('app_devise_dollar') ? 2 : 1;
        $now = new DateTime();
        $now->setTimezone(new DateTimeZone('Europe/Paris'));

        $activity = new Activite($now->format('Y-01-01'), $now->format('Y-m-d'), null, null, null);

        $log = new ActiviteLogger($now->format('Y-m-d H:i:s'), $activity->getMontant($devise), $activity->getCom($devise), $activity->getMts($devise), $activity->getPcsAccessoires($devise), $activity->getPcsNonAccessoires($devise));
        $result = $log->save();

        if ($result) {
          echo "Erreur dans l'enregistrement des valeurs : ".$now->format('Y-m-d H:i:s').", ".$activity->getMontant($devise).", ".$activity->getCom($devise).", ".$activity->getMts($devise).", ".$activity->getPcsAccessoires($devise).", ".$activity->getPcsNonAccessoires($devise)."\n";
        }
    }

}
