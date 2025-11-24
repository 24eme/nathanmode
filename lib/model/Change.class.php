<?php
class Change
{
  const API_URL = 'https://api.frankfurter.app/latest?from=EUR&to=USD';
  const FILENAME = 'usd_eur.json';

  public $json = null;
  private static $_instance = null;

	public static function getInstance($context = null)
    {
       	if(is_null(self::$_instance)) {
       		self::$_instance = new self();
		}
		return self::$_instance;
  }

  public function __construct()
  {
    if (!file_exists(self::getFilePath())) {
      self::storeTaux();
    }
    $json = file_get_contents(self::getFilePath());
    if (!$json) {
        throw new Exception("Impossible de récupérer les données de change depuis le fichier ".self::getFilePath());
    }
    $this->json = json_decode($json, true);
  }

  public static function getFilePath()
  {
    return sfConfig::get('sf_data_dir').'/'.self::FILENAME;
  }

  public static function storeTaux()
  {
    $json = file_get_contents(self::API_URL);
    if ($json === false) {
        throw new Exception("Impossible de récupérer les données de change depuis l'API frankfurter");
    }
    $save = file_put_contents(self::getFilePath(), $json);
    if ($save === false) {
        throw new Exception("Impossible d'écrire les données de change dans le fichier ".self::getFilePath());
    }
    return $json;
  }

  public function getUSDRate()
  {
      if(!isset($this->json["rates"]["USD"])) {
          return;
      }
    return $this->json["rates"]["USD"];
  }

  public function getEURRate()
  {
      if(!$this->getUSDRate()) {
          return;
      }
    return round(1 / $this->getUSDRate(),5);
  }

  public function convertToUSD($eur)
  {
    return $eur * $this->getUSDRate();
  }

  public function convertToEUR($usd)
  {
    return $usd * $this->getEURRate();
  }

  public static function getInfos()
  {
    if ($json = file_get_contents(self::getFilePath())) {
      $datas = json_decode($json, true);
      return (new DateTime($datas['date']))->format('d/m/Y').' : '.$datas['amount'].' '.$datas['base'].' = '.$datas['rates'][array_key_first($datas['rates'])].' '.array_key_first($datas['rates']);
    }
    return 'No data to parse';
  }
}
