<?php

require_once dirname(__FILE__).'/../lib/productiondetailsGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/productiondetailsGeneratorHelper.class.php';

/**
 * productiondetails actions.
 *
 * @package    nathanmode
 * @subpackage productiondetails
 * @author     Your name here
 * @version    SVN: $Id$
 */
class productiondetailsActions extends autoProductiondetailsActions
{
  protected function buildQuery()
  {
    $query = parent::buildQuery();
    $query->whereNotIn('situation', array(Situations::SITUATION_SOLDEE, Situations::SITUATION_ECRU_DESIGNER));
    return $query;
  }

  protected function buildQuerySoldees()
  {
    $query = parent::buildQuery();
    $query->whereIn('situation', array(Situations::SITUATION_SOLDEE, Situations::SITUATION_ECRU_DESIGNER));
    return $query;
  }

  public function executeCommandesSoldees(sfWebRequest $request)
  {
    if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort'))) {
      $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
    }
    if ($request->getParameter('page')) {
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
    $export = new ExportCsv("export-".$this->getModuleName()."-soldees.csv", array_values($headers));
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

  public function executeListCsv(sfWebRequest $request)
  {
    $query = $this->buildQuery();
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
    $pager = $this->configuration->getPager('productiondetails');
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
        $parsedUrl = parse_url($referer);
        if (!$parsedUrl) {
          $this->redirect('@collection_detail');
        }
        $referer = $parsedUrl['scheme'] . '://' . $parsedUrl['host'] . $parsedUrl['path'];
        $this->redirect($referer);
  		} else {
        $this->redirect('@collection_detail');
  		}
    }

    $this->filters = $this->configuration->getFilterForm($this->getFilters());

    $this->filters->bind($request->getParameter($this->filters->getName()));
    if ($this->filters->isValid())
    {
      $this->setFilters($this->filters->getValues());

      if ($referer = $request->getReferer()) {
        $parsedUrl = parse_url($referer);
        if (!$parsedUrl) {
          $this->redirect('@collection_detail');
        }
        $referer = $parsedUrl['scheme'] . '://' . $parsedUrl['host'] . $parsedUrl['path'];
        $this->redirect($referer);
  		} else {
        $this->redirect('@collection_detail');
  		}
    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();

    $this->setTemplate('index');
  }
}
