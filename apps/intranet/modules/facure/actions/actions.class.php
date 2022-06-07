<?php

require_once dirname(__FILE__).'/../lib/facureGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/facureGeneratorHelper.class.php';

/**
 * facure actions.
 *
 * @package    nathanmode
 * @subpackage facure
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class facureActions extends autoFacureActions
{

  public function executeBatchStatutPayee(sfWebRequest $request) {
    $ids = $request->getParameter('ids');
    $date = $request->getParameter('date', date('Y-m-d'));
    $query = parent::buildQuery();
    $rootAlias = $query->getRootAlias();
    $query->whereIn($rootAlias.'.id', $ids);
    $factures = $query->execute();
    foreach ($factures as $facture) {
      $facture->isPayee($date);
      $facture->save();
    }
    $this->getUser()->setFlash('notice', 'Les factures séléctionnées ont bien été marquées comme payées au '.$date);
  	$this->redirect('@facture');
  }

  protected function buildQuery()
  {
    $query = parent::buildQuery();
    $rootAlias = $query->getRootAlias();
    $query->leftJoin($rootAlias.'.Fournisseur f')
    	  ->leftJoin($rootAlias.'.Saison s')
    	  ->leftJoin($rootAlias.'.Client cl')
    	  ->leftJoin($rootAlias.'.Commercial co');
   $query->addWhere($rootAlias.'.statut = "'.StatutsFacture::KEY_NON_PAYEE.'" OR year('.$rootAlias.'.date) = "'.date('Y').'"');
   $query->addWhere($rootAlias.'.actif = ?', true);
   $query->orderBy($rootAlias.'.statut DESC, '.$rootAlias.'.date DESC');
   return $query;
    
  }
  protected function getFilters()
  {
    $filters = parent::getFilters();
    if (isset($filters["statut"]) && !empty($filters["statut"])) {
    	if ($filters["statut"] != StatutsFacture::KEY_PAYEE) {
    		$filters["statut"] = implode('|', array_keys(StatutsFacture::getListeNonPayee()));
    	}
    }
    return $filters;
  }
  
  public function executeTest(sfWebRequest $request)
  {
  	
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
    $query = parent::buildQuery();
    $rootAlias = $query->getRootAlias();
    $query->leftJoin($rootAlias.'.Fournisseur f')
    	  ->leftJoin($rootAlias.'.Saison s')
    	  ->leftJoin($rootAlias.'.Client cl')
    	  ->leftJoin($rootAlias.'.Commercial co')
    	  ->leftJoin($rootAlias.'.DeviseMontant dm')
    	  ->leftJoin($rootAlias.'.DeviseCommercial dc')
    	  ->leftJoin($rootAlias.'.DeviseFournisseur df');
   	$query->addWhere($rootAlias.'.statut != ?', StatutsFacture::KEY_PAYEE);
   	$query->addWhere($rootAlias.'.actif = ?', true);
    $query->orderBy('f.raison_sociale ASC, '.$rootAlias.'.date ASC');
    $this->bons = $query->execute();
    $query = $this->buildCumulQuery();
    $rootAlias = $query->getRootAlias();
    $query->leftJoin($rootAlias.'.Fournisseur f')
    	  ->leftJoin($rootAlias.'.Saison s')
    	  ->leftJoin($rootAlias.'.Client cl')
    	  ->leftJoin($rootAlias.'.Commercial co')
    	  ->leftJoin($rootAlias.'.DeviseMontant dm')
    	  ->leftJoin($rootAlias.'.DeviseCommercial dc')
    	  ->leftJoin($rootAlias.'.DeviseFournisseur df');
   	$query->addWhere($rootAlias.'.statut != ?', StatutsFacture::KEY_PAYEE);
   	$query->addWhere($rootAlias.'.actif = ?', true);
    $query->orderBy('f.raison_sociale ASC, '.$rootAlias.'.date ASC');
    $this->bons_cumul = $query->execute();
  }
  
  public function executeFacturesCsv()
  {
  	$query = parent::buildQuery();
    $rootAlias = $query->getRootAlias();
    $query->leftJoin($rootAlias.'.Fournisseur f')
    	  ->leftJoin($rootAlias.'.Saison s')
    	  ->leftJoin($rootAlias.'.Client cl')
    	  ->leftJoin($rootAlias.'.Commercial co');
   	$query->addWhere($rootAlias.'.actif = ?', true);
  	$items = $query->execute();
    $headers = $this->configuration->getListDisplay();
    $export = new ExportCsv("export-".$this->getModuleName().".csv", array_values($headers));
    foreach ($items as $item) {
    	$line = array();
    	foreach($headers as $field) {
    		if (preg_match('/^_([a-zA-Z0-9\_]+)/', $field, $m)) {
    			$field = $m[1];
    		}
    		try{
    			$line[$field] = $item->$field;	
    		} catch (sfException $e) {
    			$line[$field] = null;
    		}
    	}
    	$export->add($line);
    }
    $export->configureResponse($this->getResponse());
    return $this->renderText($export->output());
  }
  
  public function executePayer(sfWebRequest $request)
  {
  	$date = explode('/', $request->getPostParameter('facture_date_debit'));
  	$datePaiement = new DateTime();
  	$datePaiement->setDate($date[2], $date[1], $date[0]);
  	$query = $this->buildQuery();
    $bons = $query->execute();
    foreach ($bons as $bon) {
    	$bon->setDateDebit($datePaiement->format('Y-m-d'));
    	$bon->setStatut(StatutsFacture::KEY_PAYEE);
    	$bon->save();
    }
  	$this->redirect('@facture');
  }
  
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));
	$object = $this->getRoute()->getObject();
	$object->setActif(false);
    if ($object->save())
    {
      $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
    }

    $this->redirect('@facture');
  }
}
