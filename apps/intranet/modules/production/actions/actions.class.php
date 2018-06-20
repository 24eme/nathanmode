<?php

require_once dirname(__FILE__).'/../lib/productionGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/productionGeneratorHelper.class.php';

/**
 * production actions.
 *
 * @package    nathanmode
 * @subpackage production
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class productionActions extends autoProductionActions
{
protected function buildQuery()
  {
    $query = parent::buildQuery();
    $rootAlias = $query->getRootAlias();
    $query->leftJoin($rootAlias.'.Fournisseur f')
    	  ->leftJoin($rootAlias.'.Saison s')
    	  ->leftJoin($rootAlias.'.Client cl')
    	  ->leftJoin($rootAlias.'.Commercial co');
    $query->whereNotIn($rootAlias.'.situation', array(Situations::SITUATION_SOLDEE, Situations::SITUATION_ECRU_DESIGNER));
   return $query;
    
  }
  
protected function buildQuerySoldees()
  {
    $query = parent::buildQuery();
    $rootAlias = $query->getRootAlias();
    $query->leftJoin($rootAlias.'.Fournisseur f')
    	  ->leftJoin($rootAlias.'.Saison s')
    	  ->leftJoin($rootAlias.'.Client cl')
    	  ->leftJoin($rootAlias.'.Commercial co');
    $query->whereIn($rootAlias.'.situation', array(Situations::SITUATION_SOLDEE, Situations::SITUATION_ECRU_DESIGNER));
   return $query;
    
  }
  public function executeCommandesSoldees(sfWebRequest $request)
  {

    // sorting
    if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort')))
    {
      $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
    }

    // pager
    if ($request->getParameter('page'))
    {
      $this->setPage($request->getParameter('page'));
    }

    $this->pager = $this->getPagerSoldees();
    $this->sort = $this->getSort();
  }
  public function executeListCsvSoldees(sfWebRequest $request)
  {
    $query = $this->buildQuerySoldees();
    $items = $query->execute();
    $headers = $this->configuration->getListDisplay();
    $export = new ExportCsv("export-".$this->getModuleName().".csv", array_values($headers));
    foreach ($items as $item) {
    	$line = array();
    	foreach($headers as $field) {
    		$field = str_replace('_', '', $field);
    		try{
    			$line[$field] = $item->$field;	
    		} catch (Exception $e) {
    			$line[$field] = null;
    		}
    	}
    	$export->add($line);
    }
    $export->configureResponse($this->getResponse());
    return $this->renderText($export->output());
  }
  protected function getPagerSoldees()
  {
    $pager = $this->configuration->getPager('production');
    $pager->setQuery($this->buildQuerySoldees());
    $pager->setPage($this->getPage());
    $pager->init();

    return $pager;
  }

  public function executeFilter(sfWebRequest $request)
  {
    $this->setPage(1);

    if ($request->hasParameter('_reset'))
    {
      $this->setFilters($this->configuration->getFilterDefaults());
		if ($referer = $request->getReferer()) {
			$this->redirect($referer);
		} else {
      		$this->redirect('@production');
		}
    }

    $this->filters = $this->configuration->getFilterForm($this->getFilters());

    $this->filters->bind($request->getParameter($this->filters->getName()));
    if ($this->filters->isValid())
    {
      $this->setFilters($this->filters->getValues());
    
		if ($referer = $request->getReferer()) {
			$this->redirect($referer);
		} else {
      		$this->redirect('@production');
		}
    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();

    $this->setTemplate('index');
  }
}
