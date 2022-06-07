<?php

require_once dirname(__FILE__).'/../lib/collectionGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/collectionGeneratorHelper.class.php';

/**
 * collection actions.
 *
 * @package    nathanmode
 * @subpackage collection
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class collectionActions extends autoCollectionActions
{
    
    public function initialize($context, $moduleName, $actionName)
    {
        parent::initialize($context, $moduleName, $actionName);

        $this->dispatcher->connect('admin.save_object', array($this, 'saveObject'));
    }

    public function saveObject($event) {
        $object = $event['object'];
        if ($this->getRequest()->hasParameter('save_and_production'))
        {
            $object->production = true;
            $object->save();

            return $this->redirect('collection_production_edit', $object);
        }
    }

  
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
    $pager = $this->configuration->getPager('collection');
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
      		$this->redirect('@collection');
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
      		$this->redirect('@collection');
		}
    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();

    $this->setTemplate('index');
  }


  public function executeGetbysaisonqualite(sfWebRequest $request)
  {
    //$this->forward404Unless($request->isXmlHttpRequest());
    $saisonId = $request->getGetParameter('saison');
    $saison = SaisonTable::getInstance()->findOneBy('id', $saisonId);
    $saisons = SaisonTable::getInstance()->findOneBy('id', $saisonId)->getSaisonsForAlert();
    $clientId = $request->getGetParameter('client');
    $qualite = $request->getGetParameter('qualite');
    $checkInCoupe = boolval($request->getParameter('coupe'));
    $this->forward404Unless(($saisonId && $qualite && $clientId));
    $items = CollectionTable::getInstance()->getBySaisonQualiteNotClient($saisonId, $qualite, $clientId);
    if($checkInCoupe) {
        $items = array_merge($items->getData(), CoupeTable::getInstance()->getBySaisonQualiteNotClient($saisonId, $qualite, $clientId)->getData());
    }
    foreach($saisons as $s) {
        $items = array_merge($items->getData(), CollectionTable::getInstance()->getBySaisonQualiteNotClient($s->getId(), $qualite, $clientId)->getData());
        if($checkInCoupe) {
            $items = array_merge($items->getData(), CoupeTable::getInstance()->getBySaisonQualiteNotClient($s->getId(), $qualite, $clientId)->getData());
        }
    }
    $result = array();
    foreach($items as $item) {
        $libelle = $item->getId().' - '.$item->getSaison()->getLibelle().' / '.$item->getClient()->getRaisonSociale();
      if($item instanceof Coupe) {
          $libelle = '(coupe) '.$libelle;
          $result[$this->generateUrl('coupe_edit', $item)] = $libelle;
          continue;
      }
      $isProduction = $item->getProduction();
      $url = ($isProduction)? $this->generateUrl('collection_production_edit', $item) : $this->generateUrl('collection_edit', $item);
      $libelle = (($isProduction)? '(production) ' : '(collection) ').$libelle;
      $result[$url] = $libelle;
    }
    echo ($result)? json_encode($result): null;
    return sfView::NONE;
  }

}
