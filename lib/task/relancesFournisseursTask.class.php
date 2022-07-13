<?php

class relancesFournisseursTask extends sfBaseTask {


    protected function configure() {

        $this->addOptions(array(
            new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'intranet'),
            new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'prod'),
            new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
        ));

        $this->namespace = 'relances';
        $this->name = 'fournisseurs';
        $this->briefDescription = '';
        $this->detailedDescription = <<<EOF
La tâche [relances:fournisseurs|INFO] relance les fournisseurs pour les commandes non livrées à J-15 et J-7

  [php symfony relances:fournisseurs|INFO]
EOF;
    }

    protected function execute($arguments = array(), $options = array()) {
        $databaseManager = new sfDatabaseManager($this->configuration);
        $connection = $databaseManager->getDatabase($options['connection'])->getConnection();
        $contextInstance = sfContext::createInstance($this->configuration);

        $relancesTypes = array(
          array("isproduction" => 1, "nbjouravantretard" => 15, "nbrelance" => 0, "email" => "firstProductionRelance"),
          array("isproduction" => 1, "nbjouravantretard" => 7, "nbrelance" => 1, "email" => "secondProductionRelance"),
          array("isproduction" => 0, "nbjouravantretard" => 15, "nbrelance" => 0, "email" => "collectionRelance"),
          array("isproduction" => 0, "nbjouravantretard" => 7, "nbrelance" => 1, "email" => "collectionRelance"),
        );
        $log = '';
        foreach($relancesTypes as $relanceType) {
          $items = CollectionTable::getInstance()->getNonLivres($relanceType['isproduction'], $relanceType['nbjouravantretard'], $relanceType['nbrelance']);
          $itemsByFournisseurs = $this->organizeByFournisseur($items, $relanceType['nbjouravantretard']);
          foreach($itemsByFournisseurs as $idFournisseur => $itemsByFournisseur) {
            $fournisseur = FournisseurTable::getInstance()->findOneById($idFournisseur);
            $fournisseurEmails = ($fournisseur->emails)? explode(',', $fournisseur->emails) : null;
            if ($fournisseurEmails && !is_array($fournisseurEmails)) {
              $fournisseurEmails = array($fournisseurEmails);
            }
            $correspondantEmails = $this->getEmailCorrespondants($itemsByFournisseur);
            $emailType = $relanceType['email'];
            if ($fournisseurEmails) {
              try {
                Email::getInstance($contextInstance)->$emailType($itemsByFournisseur, $fournisseurEmails, $correspondantEmails);
                $this->increaseNbRelanceForItems($itemsByFournisseur);
                foreach($itemsByFournisseur as $item) {
                  echo date('Y-m-d H:i:s').' / '.$item->id.' / '.implode(',', $correspondantEmails)."\n";
                }
              } catch(Exception $e) {
                $log .= '<li>'.$e->getMessage().'</li>';
              }
            } else {
              $log .= "<li>Aucune adresse e-mail n'est configurée pour le fournisseur $fournisseur</li>";
            }
          }
        }
        if ($log) {
          Email::getInstance($contextInstance)->logErreurRelance("<ul>$log</ul>");
        }
    }

    private function increaseNbRelanceForItems($items) {
      foreach($items as $item) {
        $item->nb_relance = $item->nb_relance + 1;
        $item->save();
      }
    }

    private function getEmailCorrespondants($items) {
      $result = array();
      foreach($items as $item) {
        $emails =  ($item->getClient()->emails)? explode(',', str_replace(" ", "", str_replace(';', ',', $item->getClient()->emails))) : null;
        if ($emails && !is_array($emails)) {
          $emails = array($emails);
        }
        if ($emails) {
          $result = array_merge($result, $emails);
        }
      }
      return $result;
    }

    private function organizeByFournisseur($items, $nbJour) {
      $result = array();
      foreach($items as $item) {
        if (!$item->isInRetardDespiteTimeExtension(date('Y-m-d', strtotime("+$nbJour day")))) continue;
        if (!isset($result[$item->fournisseur_id])) {
          $result[$item->fournisseur_id] = array();
        }
        $result[$item->fournisseur_id][] = $item;
      }
      return $result;
    }

}
