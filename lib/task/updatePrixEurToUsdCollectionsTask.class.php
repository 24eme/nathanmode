<?php
class updatePrixEurToUsdCollectionsTask extends sfBaseTask
{

  const FILENAME = 'eurofxref-hist.csv';
  public $taux = [];

  protected function configure()
  {
    $this->addArguments(array(

    ));
    $this->addOptions(array(
        new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'linup'),
        new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
        new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
    ));
    $this->namespace = 'collections';
    $this->name = 'update-prix-eur-to-usd';
    $this->briefDescription = '';
    $this->detailedDescription = '';
  }

  protected function execute($arguments = array(), $options = array())
  {
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    $this->complileTaux();

    $coupes = CoupeTable::getInstance()->findAll();
    foreach ($coupes as $coupe) {
      if ($coupe->getFournisseurId() == 100) continue; // Fournisseur en euro
      if ($coupe->getDeviseId() == 2) continue;
      $date = $coupe->getDateCommande();
      if (!$date) {
        $date = $coupe->getDateLivraison();
      }
      if (!$date) {
        $date = $coupe->getLivreLe();
      }
      if (!$date) {
        $date = array_key_last($this->taux);
      }
      $taux = $this->taux[$date] ?? null;
      if (!$taux) throw new \Exception("No entry for ".$date, 1);
      $prix = (float)$coupe->getPrix();
      $montant = (float)$coupe->getMontantFacture();
      $coupe->setDeviseId(2);
      if ($prix > 0) {
        $coupe->setPrix(round($prix*$taux, 2));
        echo 'COUPE '.$coupe->getId().' '.$date.' '.$taux.' '.$prix.' € => '.round($prix*$taux, 2)." $\n";
      }
      if ($montant > 0) {
        $coupe->setMontantFacture(round($montant*$taux, 2));
        echo 'COUPE '.$coupe->getId().' '.$date.' '.$montant.' '.$prix.' € => '.round($montant*$taux, 2)." $\n";
      }
      $coupe->save();
    }

    $collections = CollectionTable::getInstance()->findAll();
    foreach ($collections as $collection) {
      if ($collection->getFournisseurId() == 100) continue; // Fournisseur en euro
      $date = $collection->getDateCommande();
      if (!$date) {
        $date = $collection->getDateLivraison();
      }
      if (!$date) {
        foreach ($collection->getCollectionLivraisons() as $livraison) {
          if ($livraison->getDate()) {
            $date = $livraison->getDate();
          }
        }
      }
      if (!$date) {
        $date = array_key_last($this->taux);
      }
      $taux = $this->taux[$date] ?? null;
      if (!$taux) throw new \Exception("No entry for ".$date, 1);
      foreach ($collection->getCollectionDetails() as $detail) {
        if ($detail->getDeviseId() == 2) continue;
        $prix = (float)$detail->getPrix();
        $detail->setDeviseId(2);
        if ($prix > 0) {
          $detail->setPrix(round($prix*$taux, 2));
          echo 'DETAIL '.$collection->getId().' '.$date.' '.$taux.' '.$prix.' € => '.round($prix*$taux, 2)." $\n";
        }
        $detail->save();
      }
      foreach ($collection->getCollectionLivraisons() as $livraison) {
        if ($livraison->getDeviseId() == 2) continue;
        $prix = (float)$livraison->getPrix();
        $livraison->setDeviseId(2);
        if ($prix > 0) {
          $livraison->setPrix(round($prix*$taux, 2));
          echo 'LIVRAISON '.$collection->getId().' '.$date.' '.$taux.' '.$prix.' € => '.round($prix*$taux, 2)." $\n";
        }
        $livraison->save();
      }
      $collection->save();
    }

    $collections = CollectionTable::getInstance()->findAll();
    foreach ($collections as $collection) {
    foreach ($collection->getCollectionDetails() as $detail) {
      if (strpos($detail->getColori(), '$') !== false) {
        $detail->delete();
      }
    }
  }

  }

  private function complileTaux()
  {
    $csvFile = sfConfig::get('sf_data_dir').'/'.self::FILENAME;
    if (!file_exists($csvFile)) throw new \Exception(sfConfig::get('sf_data_dir').'/'.self::FILENAME." missing file", 1);
    if (($handle = fopen($csvFile, "r")) !== false) {
      $headers = fgetcsv($handle);
      while (($row = fgetcsv($handle)) !== false) {
          $this->taux[$row[0]] = (float) $row[1];
      }
      fclose($handle);
    }
    ksort($this->taux);
    $start = new DateTime(array_key_first($this->taux));
    $end = new DateTime(array_key_last($this->taux));
    $period = new DatePeriod($start, new DateInterval('P1D'), $end->modify('+1 day'));
    $last = null;
    foreach ($period as $date) {
        $d = $date->format('Y-m-d');
        if (isset($this->taux[$d])) {
            $last = $this->taux[$d];
            continue;
        }
        $this->taux[$d] = $last;
    }
  }
}
