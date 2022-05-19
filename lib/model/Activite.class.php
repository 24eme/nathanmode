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
	);

	public function __construct($from, $to, $saison, $commercial, $produit)
	{
		$this->from = $from;
		$this->to = $to;
		$this->saison = $saison;
		$this->commercial = $commercial;
		$this->produit = $produit;
	}
	
	public function getMontant($devise = 1, $client = null, $fournisseur = null)
	{
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

		$reqFacture = "SELECT SUM(b.montant) as montant FROM commande b WHERE b.date <= '".$this->to."' AND b.date >= '".$this->from."' AND b.devise_montant_id = ".$devise." AND b.montant > 0".$where;
		$reqCredit = "SELECT SUM(b.montant_total) as montant FROM bon b WHERE b.type != 'Facture' AND b.date <= '".$this->to."' AND b.date >= '".$this->from."' AND b.devise_montant_id = ".$devise." AND b.montant_total > 0".$where;
		$req = "SELECT (".$reqFacture.") as facture, (".$reqCredit.") as credit, (SELECT ifnull(facture,0) - ifnull(credit,0)) as total";

		$result = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($req);

		return ($result[0]['total'])? $result[0]['total'] : 0;

	}

	public function getCom($devise = 1, $client = null, $fournisseur = null)
	{
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

		$reqFacture = "SELECT SUM(b.total_fournisseur) as montant FROM commande b WHERE b.date <= '".$this->to."' AND b.date >= '".$this->from."' AND b.devise_montant_id = ".$devise." AND b.montant > 0".$where;
		$reqCredit = "SELECT SUM(b.total_fournisseur) as montant FROM bon b WHERE b.type != 'Facture' AND b.date <= '".$this->to."' AND b.date >= '".$this->from."' AND b.devise_montant_id = ".$devise." AND b.montant > 0".$where;
		$req = "SELECT (".$reqFacture.") as facture, (".$reqCredit.") as credit, (SELECT ifnull(facture,0) - ifnull(credit,0)) as total";

		$result = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($req);

		return ($result[0]['total'])? $result[0]['total'] : 0;

	}

	public function getMts($devise = 1, $client = null, $fournisseur = null)
	{
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

		$reqFacture = "SELECT SUM(b.metrage) as montant FROM commande b WHERE b.date <= '".$this->to."' AND b.date >= '".$this->from."' AND b.devise_montant_id = ".$devise." AND b.montant > 0".$where;
		$reqCredit = "SELECT SUM(b.metrage) as montant FROM bon b WHERE b.type != 'Facture' AND b.date <= '".$this->to."' AND b.date >= '".$this->from."' AND b.devise_montant_id = ".$devise." AND b.montant > 0".$where;
		$req = "SELECT (".$reqFacture.") as facture, (".$reqCredit.") as credit, (SELECT ifnull(facture,0) - ifnull(credit,0)) as total";

		$result = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($req);

		return ($result[0]['total'])? $result[0]['total'] : 0;

	}

	private function getPcs($devise = 1, $client = null, $fournisseur = null, $accessoire = true)
	{
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
		if ($accessoire) {
			$where .= " AND b.piece_categorie = 'ACCESSOIRES'";
		} else {
			$where .= " AND (b.piece_categorie != 'ACCESSOIRES' OR b.piece_categorie IS NULL OR b.piece_categorie = '')";
		}
		if (preg_match("/^pcs_/", $this->produit)) {
			$where .= " AND b.piece_categorie = '".str_replace("pcs_", "", $this->produit)."' AND b.piece IS NOT NULL AND b.piece != ''";
		}

		$reqFacture = "SELECT SUM(b.piece) as montant FROM commande b WHERE b.date <= '".$this->to."' AND b.date >= '".$this->from."' AND b.devise_montant_id = ".$devise." AND b.montant > 0".$where;
		$reqCredit = "SELECT SUM(b.piece) as montant FROM bon b WHERE b.type != 'Facture' AND b.date <= '".$this->to."' AND b.date >= '".$this->from."' AND b.devise_montant_id = ".$devise." AND b.montant > 0".$where;

		$req = "SELECT (".$reqFacture.") as facture, (".$reqCredit.") as credit, (SELECT ifnull(facture,0) - ifnull(credit,0)) as total";

		$result = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($req);

		return ($result[0]['total'])? $result[0]['total'] : 0;

	}

	public function getPcsAccessoires($devise = 1, $client = null, $fournisseur = null)
	{
		return $this->getPcs($devise, $client, $fournisseur, true);
	}

	public function getPcsNonAccessoires($devise = 1, $client = null, $fournisseur = null)
	{
		return $this->getPcs($devise, $client, $fournisseur, false);
	}

	public function getDetails($devise = 1, $client = null, $fournisseur = null)
	{
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

		$reqFacture = "SELECT 1 as coef, s.libelle, b.qualite, sum(b.metrage) as metrage, sum(b.piece) as piece, sum(b.montant) as montant FROM commande b INNER JOIN saison s ON b.saison_id = s.id WHERE b.date <= '".$this->to."' AND b.date >= '".$this->from."' AND b.devise_montant_id = ".$devise." AND b.montant > 0".$where." GROUP BY s.libelle, b.qualite";
		$reqCredit = "SELECT -1 as coef, s.libelle, b.qualite, sum(b.metrage) as metrage, sum(b.piece) as piece, sum(b.montant_total) as montant FROM bon b INNER JOIN saison s ON b.saison_id = s.id WHERE b.type != 'Facture' AND b.date <= '".$this->to."' AND b.date >= '".$this->from."' AND b.devise_montant_id = ".$devise." AND b.montant_total > 0".$where." GROUP BY s.libelle, b.qualite";

		$result = array_merge(Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($reqFacture), Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($reqCredit));

		return $result;

	}

	public function getMontantByClient()
	{
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

	public function getMontantByGlobal()
	{
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
}
