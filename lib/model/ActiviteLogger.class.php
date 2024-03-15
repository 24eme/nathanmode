<?php

class ActiviteLogger
{
	private $date_log;
	private $ca;
	private $com;
	private $mts;
	private $acces;
	private $pf_cn;

	public function __construct($date_log, $ca, $com, $mts, $acces, $pf_cn) {
		$this->date_log = $date_log;
		$this->ca = $ca;
		$this->com = $com;
		$this->mts = $mts;
		$this->acces = $acces;
		$this->pf_cn = $pf_cn;
	}

	public function save() {
		$req = 'INSERT INTO commercial_activity_logger (date_log, ca, com, mts, acces, pf_cn) VALUES (\''.$this->date_log.'\', '.$this->ca.', '.$this->com.', '.$this->mts.', '.$this->acces.', '.$this->pf_cn.');';
		return Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($req);
	}

	public static function getLogs($from, $to) {
		$req = "SELECT * from commercial_activity_logger WHERE date_log BETWEEN '$from' AND '$to';";
		return Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($req);
	}

	public static function categorizeLogs($logs) {
		$result = ["ca" => [], "com" => [], "mts" => [], "acces" => [], "pf_cn" => []];
		foreach ($logs as $log) {
			$key = $log["date_log"];
			$result["ca"][$key] = $log["ca"];
			$result["com"][$key] = $log["com"];
			$result["mts"][$key] = $log["mts"];
			$result["acces"][$key] = $log["acces"];
			$result["pf_cn"][$key] = $log["pf_cn"];
		}
		return $result;
	}
}
