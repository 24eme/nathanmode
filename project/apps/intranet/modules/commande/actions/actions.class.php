<?php

require_once dirname(__FILE__).'/../lib/commandeGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/commandeGeneratorHelper.class.php';

/**
 * commande actions.
 *
 * @package    nathanmode
 * @subpackage commande
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class commandeActions extends autoCommandeActions
{


  protected function buildQuery()
  {
    $query = parent::buildQuery();
    $rootAlias = $query->getRootAlias();
    $query->leftJoin($rootAlias.'.Fournisseur f')
    	  ->leftJoin($rootAlias.'.Saison s')
    	  ->leftJoin($rootAlias.'.Client cl')
    	  ->leftJoin($rootAlias.'.Commercial co')
    	  ->leftJoin($rootAlias.'.DeviseMontant dm')
    	  ->leftJoin($rootAlias.'.DeviseFournisseur df')
    	  ->leftJoin($rootAlias.'.DeviseCommercial dc');
   return $query;
    
  }
  
  public function buildCumulQuery()
  {
    $tableMethod = $this->configuration->getTableMethod();
    if (null === $this->filters)
    {
      $this->filters = $this->configuration->getFilterForm($this->getFilters());
    }
    	$filters = $this->getFilters();
    	if (!isset($filters['date'])) {
    		$filters['date'] = array();
    	}
    	$filters['date']['from'] = date('Y').'-01-01';
    	$filters['date']['to'] = date('Y-m-d');

    $this->filters->setTableMethod($tableMethod);

    $query = $this->filters->buildQuery($filters);

    $this->addSortQuery($query);

    $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
    $query = $event->getReturnValue();

    return $query;
  }
  
  public function executeStats(sfWebRequest $request)
  {
  	
  	$filters = $this->getFilters();
  	if (isset($filters['date'])) {
  		$this->hasDate = true;
  		$this->from = $filters['date']['from'];
  		$this->to = $filters['date']['to'];
  	} else {
  		$this->hasDate = false;
  		$this->from = null;
  		$this->to = null;
  	}
  	
  	if ($this->from && $this->to) {
    	$from = new DateTime($this->from);
    	$to = new DateTime($this->to);
    	
    	$fromCumul = new DateTime($from->format('Y').'-01-01');
    	$this->toCumul = new DateTime($to->format('Y-m-d'));
    	$this->fromCumul = new DateTime($fromCumul->format('Y-m-d'));
    	$this->n = $this->reqStats($from->format('Y-m-d'), $to->format('Y-m-d'));
    	$this->cn = $this->reqStats($fromCumul->format('Y-m-d'), $to->format('Y-m-d'));
    	
    	$from->modify('-1 year');
    	$fromCumul->modify('-1 year');
    	$to->modify('-1 year');
    	
    	$this->toCumul1 = new DateTime($to->format('Y-m-d'));
    	$this->fromCumul1 = new DateTime($fromCumul->format('Y-m-d'));
    	$this->n1 = $this->reqStats($from->format('Y-m-d'), $to->format('Y-m-d'));
    	$this->cn1 = $this->reqStats($fromCumul->format('Y-m-d'), $to->format('Y-m-d'));
    	
    	$from->modify('-1 year');
    	$fromCumul->modify('-1 year');
    	$to->modify('-1 year');
    	
    	$this->toCumul2 = new DateTime($to->format('Y-m-d'));
    	$this->fromCumul2 = new DateTime($fromCumul->format('Y-m-d'));
    	$this->n2 = $this->reqStats($from->format('Y-m-d'), $to->format('Y-m-d'));
    	$this->cn2 = $this->reqStats($fromCumul->format('Y-m-d'), $to->format('Y-m-d'));
    } else {
    	$this->n = array();
    	$this->n1 = array();
    	$this->n2 = array();
    	$this->cn = array();
    	$this->cn1 = array();
    	$this->cn2 = array();
    }
  	
  }
  
  public function executeRapport(sfWebRequest $request)
  {
  	
  	$filters = $this->getFilters();
  	if (isset($filters['date'])) {
  		$this->hasDate = true;
  		$this->from = $filters['date']['from'];
  		$this->to = $filters['date']['to'];
  	} else {
  		$this->hasDate = false;
  		$this->from = null;
  		$this->to = null;
  	}
    $query = $this->buildQuery();
    $rootAlias = $query->getRootAlias();
    $query->orderBy('f.raison_sociale ASC, cl.raison_sociale ASC');
    $this->commandes = $query->execute();
    $query = $this->buildCumulQuery();
    $this->commandes_cumul = $query->execute();
    if ($this->from && $this->to) {
    	$from = new DateTime($this->from);
    	$to = new DateTime($this->to);
    	$fromCumul = new DateTime($from->format('Y').'-01-01');
    	$this->toCumul = new DateTime($to->format('Y-m-d'));
    	$this->fromCumul = new DateTime($fromCumul->format('Y-m-d'));
    	$this->cn = $this->reqSpec($fromCumul->format('Y-m-d'), $to->format('Y-m-d'));
    	$from->modify('-1 year');
    	$fromCumul->modify('-1 year');
    	$to->modify('-1 year');
    	$this->toCumul1 = new DateTime($to->format('Y-m-d'));
    	$this->fromCumul1 = new DateTime($fromCumul->format('Y-m-d'));
    	$this->n1 = $this->reqSpec($from->format('Y-m-d'), $to->format('Y-m-d'));
    	$this->cn1 = $this->reqSpec($fromCumul->format('Y-m-d'), $to->format('Y-m-d'));
    	$from->modify('-1 year');
    	$fromCumul->modify('-1 year');
    	$to->modify('-1 year');
    	$this->toCumul2 = new DateTime($to->format('Y-m-d'));
    	$this->fromCumul2 = new DateTime($fromCumul->format('Y-m-d'));
    	$this->n2 = $this->reqSpec($from->format('Y-m-d'), $to->format('Y-m-d'));
    	$this->cn2 = $this->reqSpec($fromCumul->format('Y-m-d'), $to->format('Y-m-d'));
    } else {
    	$this->n1 = array();
    	$this->n2 = array();
    	$this->cn = array();
    	$this->cn1 = array();
    	$this->cn2 = array();
    }
  }
  
  protected function reqStats($to, $from)
  {
  	
  		$reqEur = "SELECT SUM(b.metrage) as metrage, SUM(b.montant) as montant, SUM(b.total_fournisseur) as nm, SUM(b.total_commercial) as cc FROM commande b WHERE b.date <= '".$from."' AND b.date >= '".$to."' AND b.devise_montant_id = 1";
  		$reqDoll = "SELECT SUM(b.metrage) as metrage, SUM(b.montant) as montant, SUM(b.total_fournisseur) as nm, SUM(b.total_commercial) as cc FROM commande b WHERE b.date <= '".$from."' AND b.date >= '".$to."' AND b.devise_montant_id = 2";
		
		$resultEur = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($reqEur);
		$resultDoll = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($reqDoll);
		
  		$result = array();
		foreach ($resultEur as $re) {
			$metrage = ($re['metrage'])? $re['metrage'] : 0;
			$montant = ($re['montant'])? $re['montant'] : 0;
			$nm = ($re['nm'])? $re['nm'] : 0;
			$cc = ($re['cc'])? $re['cc'] : 0;
			if (!isset($result['STATS'])) {
				$result['STATS'] = array('metrage' => $metrage, 'montant_eur' => $montant, 'montant_doll' => 0, 'nm_eur' => $nm, 'nm_doll' => 0, 'cc_eur' => $cc, 'cc_doll' => 0);
			} else {
				$result['STATS']['metrage'] += $metrage;
				$result['STATS']['montant_eur'] += $montant;
				$result['STATS']['nm_eur'] += $nm;
				$result['STATS']['cc_eur'] += $cc;
			}
		}
		foreach ($resultDoll as $re) {
			$metrage = ($re['metrage'])? $re['metrage'] : 0;
			$montant = ($re['montant'])? $re['montant'] : 0;
			$nm = ($re['nm'])? $re['nm'] : 0;
			$cc = ($re['cc'])? $re['cc'] : 0;
			if (!isset($result['STATS'])) {
				$result['STATS'] = array('metrage' => $metrage, 'montant_eur' => 0, 'montant_doll' => $montant, 'nm_eur' => 0, 'nm_doll' => $nm, 'cc_eur' => 0, 'cc_doll' => $cc);
			} else {
				$result['STATS']['metrage'] += $metrage;
				$result['STATS']['montant_doll'] += $montant;
				$result['STATS']['nm_doll'] += $nm;
				$result['STATS']['cc_doll'] += $cc;
			}
		}
		return $result;
  }
  
  protected function reqSpec($to, $from)
  {
  		$reqEur = "SELECT b.fournisseur_id as fournisseur, SUM(b.metrage) as metrage, SUM(b.montant) as montant, SUM(b.total_fournisseur) as nm, SUM(b.total_commercial) as cc FROM commande b WHERE b.date <= '".$from."' AND b.date >= '".$to."' AND b.devise_montant_id = 1 GROUP BY fournisseur";
  		$reqDoll = "SELECT b.fournisseur_id as fournisseur, SUM(b.metrage) as metrage, SUM(b.montant) as montant, SUM(b.total_fournisseur) as nm, SUM(b.total_commercial) as cc FROM commande b WHERE b.date <= '".$from."' AND b.date >= '".$to."' AND b.devise_montant_id = 2 GROUP BY fournisseur";
		
		$resultEur = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($reqEur);
		$resultDoll = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($reqDoll);
		
  		$result = array();
		foreach ($resultEur as $re) {
			$metrage = ($re['metrage'])? $re['metrage'] : 0;
			$montant = ($re['montant'])? $re['montant'] : 0;
			$nm = ($re['nm'])? $re['nm'] : 0;
			$cc = ($re['cc'])? $re['cc'] : 0;
			if (!isset($result[$re['fournisseur']])) {
				$result[$re['fournisseur']] = array('metrage' => $metrage, 'montant_eur' => $montant, 'montant_doll' => 0, 'nm_eur' => $nm, 'nm_doll' => 0, 'cc_eur' => $cc, 'cc_doll' => 0);
			} else {
				$result[$re['fournisseur']]['metrage'] += $metrage;
				$result[$re['fournisseur']]['montant_eur'] += $montant;
				$result[$re['fournisseur']]['nm_eur'] += $nm;
				$result[$re['fournisseur']]['cc_eur'] += $cc;
			}
		}
		foreach ($resultDoll as $re) {
			$metrage = ($re['metrage'])? $re['metrage'] : 0;
			$montant = ($re['montant'])? $re['montant'] : 0;
			$nm = ($re['nm'])? $re['nm'] : 0;
			$cc = ($re['cc'])? $re['cc'] : 0;
			if (!isset($result[$re['fournisseur']])) {
				$result[$re['fournisseur']] = array('metrage' => $metrage, 'montant_eur' => 0, 'montant_doll' => $montant, 'nm_eur' => 0, 'nm_doll' => $nm, 'cc_eur' => 0, 'cc_doll' => $cc);
			} else {
				$result[$re['fournisseur']]['metrage'] += $metrage;
				$result[$re['fournisseur']]['montant_doll'] += $montant;
				$result[$re['fournisseur']]['nm_doll'] += $nm;
				$result[$re['fournisseur']]['cc_doll'] += $cc;
			}
		}
		return $result;
  }
}
