<?php

class Activite
{
	public $from;
	public $to;
	public $saison;
	public $commercial;
	public $produit;

	public static $ACCESSOIRES_CATEGORIES = array(
		"ACCESSOIRES",
		"ECHARPRES",
		"BONNETS",
		"GANTS",
		"MAROQUINERIE",
		"PONCHOS",
		"PLAIDS",
	);

	public function __construct($from, $to, $saison, $commercial, $produit) {
		$this->from = $from;
		$this->to = $to;
		$this->saison = $saison;
		$this->commercial = $commercial;
		$this->produit = $produit;
	}

	public function getMontantCsv($devise = 1, $client = null, $fournisseur = null) {
		$where = $this->getConditions($client, $fournisseur);
		$reqFacture = "SELECT DATE_FORMAT(b.date, '%d/%m/%Y') as 'Date', 'Commande' as Flux, s.libelle as Saison, REPLACE(c.raison_sociale, ',', ' ') as Client, REPLACE(CONCAT(f.raison_sociale, ' ', f.prenom), ',', ' ') as Fournisseur, REPLACE(CONCAT(co.nom, ' ', co.prenom), ',', ' ') as Commerical, REPLACE(b.numero, ',', ' ') as 'Num commande', REPLACE(b.colori, ',', ' ') as Colori, REPLACE(b.qualite, ',', ' ') as Qualite, b.situation as Situation, REPLACE(b.piece_categorie, ',', ' ') as 'Categorie piece', b.piece as 'Nb piece', b.metrage as MTS, b.montant as 'CA', b.total_fournisseur as 'COM'
		 	FROM commande b
			LEFT JOIN saison s ON b.saison_id = s.id
			LEFT JOIN client c ON b.client_id = c.id
			LEFT JOIN fournisseur f ON b.fournisseur_id = f.id
			LEFT JOIN commercial co ON b.commercial_id = co.id
			WHERE b.date <= '".$this->to."' AND b.date >= '".$this->from."' AND b.devise_montant_id = ".$devise." AND b.montant > 0".$where." ORDER BY b.id DESC";
		$reqCredit = "SELECT DATE_FORMAT(b.date, '%d/%m/%Y') as 'Date', 'Note de credit' as Flux, s.libelle as Saison, REPLACE(c.raison_sociale, ',', ' ') as Client, REPLACE(CONCAT(f.raison_sociale, ' ', f.prenom), ',', ' ') as Fournisseur, REPLACE(CONCAT(co.nom, ' ', co.prenom), ',', ' ') as Commerical, REPLACE(REPLACE(b.numero, 'Commande : ', ''), ',', ' ') as 'Num commande', NULL as Colori, REPLACE(b.qualite, ',', ' ') as Qualite, b.statut as Situation, REPLACE(b.piece_categorie, ',', ' ') as 'Categorie piece', (-1 * b.piece) as 'Nb piece', (-1 * b.metrage) as MTS, (-1 * b.montant_total) as 'CA', (-1 * b.total_fournisseur) as 'COM'
			FROM bon b
			LEFT JOIN saison s ON b.saison_id = s.id
			LEFT JOIN client c ON b.client_id = c.id
			LEFT JOIN fournisseur f ON b.fournisseur_id = f.id
			LEFT JOIN commercial co ON b.commercial_id = co.id
			WHERE b.type != 'Facture' AND b.statut IN ('DEDUITE','EN_ATTENTE','PAYEE') AND b.date <= '".$this->to."' AND b.date >= '".$this->from."' AND b.devise_montant_id = ".$devise.$where." ORDER BY b.id DESC";
		$resultFacture = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($reqFacture);
		$resultCredit = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($reqCredit);
		$entetes = '';
		if ($resultFacture) {
			$entetes = implode(';', array_keys($resultFacture[0])).PHP_EOL;
		} elseif($resultCredit) {
			$entetes = implode(';', array_keys($resultCredit[0])).PHP_EOL;
		}
		$csv = $entetes;
		$allResult = array_merge($resultFacture, $resultCredit);
		/*usort($allResult, function($a, $b) {
			return (-1 * (DateTime::createFromFormat('d/m/Y', $a['Date']) <=> DateTime::createFromFormat('d/m/Y', $b['Date'])));
		});*/
		foreach ($allResult as $item) {
			$csv .= preg_replace('/(\d)\.(\d)/', '\1,\2', implode(';', $item)).PHP_EOL;
		}
		return $csv;
	}

	public function getMontant($devise = 1, $client = null, $fournisseur = null) {
		$where = $this->getConditions($client, $fournisseur);
		return $this->getTotalCalcule('montant', $devise, $where);

	}

	public function getCom($devise = 1, $client = null, $fournisseur = null) {
		$where = $this->getConditions($client, $fournisseur);
		return $this->getTotalCalcule('total_fournisseur', $devise, $where);
	}

	public function getMts($devise = 1, $client = null, $fournisseur = null) {
		$where = $this->getConditions($client, $fournisseur);
		return $this->getTotalCalcule('metrage', $devise, $where);
	}

	public function getPcsAccessoires($devise = 1, $client = null, $fournisseur = null) {
		return $this->getPcs($devise, $client, $fournisseur, true);
	}

	public function getPcsNonAccessoires($devise = 1, $client = null, $fournisseur = null) {
		return $this->getPcs($devise, $client, $fournisseur, false);
	}

	private function getPcs($devise = 1, $client = null, $fournisseur = null, $accessoire = true) {
		$where = $this->getConditions($client, $fournisseur);
		if ($accessoire) {
			$where .= " AND b.piece_categorie IN ('".implode("','", self::$ACCESSOIRES_CATEGORIES)."')";
		} else {
			$where .= " AND (b.piece_categorie NOT IN ('".implode("','", self::$ACCESSOIRES_CATEGORIES)."') OR b.piece_categorie IS NULL OR b.piece_categorie = '')";
		}
		return $this->getTotalCalcule('piece', $devise, $where);
	}

	public function getDetailledPcs($devise = 1, $client = null, $fournisseur = null) {
		$where = $this->getConditions($client, $fournisseur);

		$reqCredit = "SELECT b.piece_categorie as categorie, SUM(b.piece) as montant FROM bon b WHERE b.type != 'Facture' AND b.statut IN ('DEDUITE','EN_ATTENTE','PAYEE') AND b.date <= '".$this->to."' AND b.date >= '".$this->from."' AND b.devise_montant_id = ".$devise.$where." GROUP BY categorie";
		$items = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($reqCredit);
		$resultCredit = array();
		foreach ($items as $item) {
			$resultCredit[$item['categorie']] = ($item['montant'])? $item['montant']*-1 : 0;
		}

		$reqFacture = "SELECT b.piece_categorie as categorie, SUM(b.piece) as montant FROM commande b WHERE b.date <= '".$this->to."' AND b.date >= '".$this->from."' AND b.devise_montant_id = ".$devise." AND b.montant > 0".$where." GROUP BY categorie";
		$items = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($reqFacture);
		$resultFacture = array();
		foreach ($items as $item) {
			$resultFacture[$item['categorie']] = ($item['montant'])? $item['montant'] : 0;
			if (isset($resultCredit[$item['categorie']])) {
					$resultFacture[$item['categorie']] += $resultCredit[$item['categorie']];
					unset($resultCredit[$item['categorie']]);
			}
		}
		foreach($resultCredit as $k => $v) {
			$resultFacture[$k] = $v;
		}
		return $resultFacture;
	}

	public function getDetails($devise = 1, $client = null, $fournisseur = null) {
		$where = $this->getConditions($client, $fournisseur);
		$reqFacture = "SELECT 1 as coef, s.libelle, b.qualite, sum(b.metrage) as metrage, sum(b.piece) as piece, sum(b.montant) as montant FROM commande b INNER JOIN saison s ON b.saison_id = s.id WHERE b.date <= '".$this->to."' AND b.date >= '".$this->from."' AND b.devise_montant_id = ".$devise." AND b.montant > 0".$where." GROUP BY s.libelle, b.qualite";
		$reqCredit = "SELECT -1 as coef, s.libelle, b.qualite, sum(b.metrage) as metrage, sum(b.piece) as piece, sum(b.montant_total) as montant FROM bon b INNER JOIN saison s ON b.saison_id = s.id WHERE b.type != 'Facture' AND b.date <= '".$this->to."' AND b.date >= '".$this->from."' AND b.devise_montant_id = ".$devise." AND b.montant_total > 0".$where." GROUP BY s.libelle, b.qualite";

		$result = array_merge(Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($reqFacture), Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($reqCredit));

		return $result;
	}

	public function getMontantByClient() {
		$reqGlobal = "SELECT c.id as id, c.raison_sociale as client FROM client c ORDER BY client ASC";
		$reqFacture = "SELECT c.id as id, c.raison_sociale as client, SUM(b.montant) as montant FROM commande b JOIN client c ON b.client_id = c.id WHERE b.date <= '".$this->to."' AND b.date >= '".$this->from."' AND b.devise_montant_id = 1 AND b.montant > 0 GROUP BY b.client_id";
		$reqCredit = "SELECT c.id as id, c.raison_sociale as client, SUM(b.montant_total) as montant FROM bon b JOIN client c ON b.client_id = c.id WHERE b.type != 'Facture' AND b.date <= '".$this->to."' AND b.date >= '".$this->from."' AND b.devise_montant_id = 1 AND b.montant_total > 0 GROUP BY b.client_id";

		$resultGlobal = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($reqGlobal);
		$resultFacture = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($reqFacture);
		$resultCredit = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($reqCredit);
		$factures = array();
		foreach ($resultGlobal as $rg) {
			$factures[$rg['id']] = array('client' => $rg['client'], 'total' => 0);
		}
		foreach ($resultFacture as $rf) {
			$factures[$rf['id']]['total'] = $factures[$rf['id']]['total'] + $rf['montant'];
		}
		foreach ($resultCredit as $rc) {
			$factures[$rc['id']]['total'] = $factures[$rc['id']]['total'] - $rc['montant'];
		}
		return $factures;
	}

	public function getMontantByGlobal() {
		$reqGlobal = "SELECT CONCAT(b.saison_id, b.client_id, b.fournisseur_id, b.qualite, b.metrage) as id, s.libelle as saison, c.raison_sociale as client, f.raison_sociale as fournisseur, b.qualite as qualite, b.metrage as metrage FROM commande b JOIN client c ON b.client_id = c.id JOIN saison s ON b.saison_id = s.id JOIN fournisseur f ON b.fournisseur_id = f.id";
		$reqFacture = "SELECT CONCAT(b.saison_id, b.client_id, b.fournisseur_id, b.qualite, b.metrage) as id, s.libelle as saison, c.raison_sociale as client, f.raison_sociale as fournisseur, b.qualite as qualite, b.metrage as metrage, SUM(b.montant) as montant FROM commande b JOIN client c ON b.client_id = c.id JOIN saison s ON b.saison_id = s.id JOIN fournisseur f ON b.fournisseur_id = f.id WHERE b.date <= '".$this->to."' AND b.date >= '".$this->from."' AND b.devise_montant_id = 1 AND b.montant > 0 GROUP BY id";
		$reqCredit = "SELECT CONCAT(b.saison_id, b.client_id, b.fournisseur_id, b.qualite, b.metrage) as id, s.libelle as saison, c.raison_sociale as client, f.raison_sociale as fournisseur, b.qualite as qualite, b.metrage as metrage, SUM(b.montant_total) as montant FROM bon b JOIN client c ON b.client_id = c.id JOIN saison s ON b.saison_id = s.id JOIN fournisseur f ON b.fournisseur_id = f.id WHERE b.type != 'Facture' AND b.date <= '".$this->to."' AND b.date >= '".$this->from."' AND b.devise_montant_id = 1 AND b.montant_total > 0 GROUP BY id";

		$resultGlobal = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($reqGlobal);
		$resultFacture = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($reqFacture);
		$resultCredit = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($reqCredit);
		$factures = array();
		foreach ($resultGlobal as $rg) {
			$factures[$rg['id']] = array('metrage' => $rg['metrage'], 'qualite' => $rg['qualite'], 'fournisseur' => $rg['fournisseur'], 'saison' => $rg['saison'], 'client' => $rg['client'], 'total' => 0);
		}
		foreach ($resultFacture as $rf) {
			$factures[$rf['id']]['total'] = $factures[$rf['id']]['total'] + $rf['montant'];
		}
		foreach ($resultCredit as $rc) {
			$factures[$rc['id']]['total'] = $factures[$rc['id']]['total'] - $rc['montant'];
		}
		return $factures;
	}

	protected function getConditions($client = null, $fournisseur = null) {
		$where = "";
		if ($client) {
			$where .= " AND b.client_id = ".$client;
		}
		if ($fournisseur) {
			$where .= " AND b.fournisseur_id = ".$fournisseur;
		}
		if ($this->saison) {
			$where .= " AND b.saison_id = ".$this->saison;
		}
		if ($this->commercial) {
			$where .= " AND b.commercial_id = ".$this->commercial;
		}
		if ($this->produit == 'mts') {
			$where .= " AND b.metrage IS NOT NULL AND b.metrage != ''";
		}
		if ($this->produit == 'pcs') {
			$where .= " AND b.piece IS NOT NULL AND b.piece != ''";
		}
		if (preg_match("/^pcs_/", $this->produit)) {
			$where .= " AND b.piece_categorie = '".str_replace("pcs_", "", $this->produit)."' AND b.piece IS NOT NULL AND b.piece != ''";
		}
		return $where;
	}

	protected function getTotalCalcule($field, $devise, $where) {
		$reqFacture = "SELECT SUM(b.$field) as montant FROM commande b WHERE b.date <= '".$this->to."' AND b.date >= '".$this->from."' AND b.devise_montant_id = ".$devise." AND b.montant > 0".$where;
		if ($field == 'montant') {
			$field .= '_total';
		}
		$reqCredit = "SELECT SUM(b.$field) as montant FROM bon b WHERE b.type != 'Facture' AND b.statut IN ('DEDUITE','EN_ATTENTE','PAYEE') AND b.date <= '".$this->to."' AND b.date >= '".$this->from."' AND b.devise_montant_id = ".$devise.$where;
		$reqTotal = "SELECT (".$reqFacture.") as facture, (".$reqCredit.") as credit, (SELECT ifnull(facture,0) - ifnull(credit,0)) as total";
		$result = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($reqTotal);

		return ($result[0]['total'])? $result[0]['total'] : 0;
	}
}
