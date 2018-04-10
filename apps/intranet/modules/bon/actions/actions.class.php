<?php

require_once dirname(__FILE__).'/../lib/bonGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/bonGeneratorHelper.class.php';

/**
 * bon actions.
 *
 * @package    nathanmode
 * @subpackage bon
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class bonActions extends autoBonActions
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
   $query->addWhere($rootAlias.'.actif = ?', true);
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
    $this->bons = $query->execute();
    $query = $this->buildCumulQuery();
    $this->bons_cumul = $query->execute();
  }
}
