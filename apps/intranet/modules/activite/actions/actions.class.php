<?php

/**
 * activite actions.
 *
 * @package    nathanmode
 * @subpackage activite
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class activiteActions extends sfActions
{
  public function preExecute()
  {
    $this->comFiltered = null;
    $commercial = $this->getUser()->getCommercial();
    if ($commercial && $commercial->getId()) {
      $this->comFiltered = $commercial;
    }

  }
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  	$this->parameters = array('ofrom' => date('Y').'-01-01', 'oto' => date('Y-m-d'), 'from' => date('Y').'-01-01', 'to' => date('Y-m-d'), 'commercial' => $this->commercial);
  }

  public function executeRapport(sfWebRequest $request)
  {
	  $from = ($request->getParameter('from'))? $request->getParameter('from') : date('Y').'-01-01';
  	$to = ($request->getParameter('to'))? $request->getParameter('to') : date('Y-m-d');
  	$this->saison = ($request->getParameter('saison'))? $request->getParameter('saison') : null;
  	$this->commercialId = ($request->getParameter('commercial'))? $request->getParameter('commercial') : null;
  	$this->produit = ($request->getParameter('produit'))? $request->getParameter('produit') : null;
  	if (preg_match('/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/', $from, $m)) {
  		$from = $m[3].'-'.$m[2].'-'.$m[1];
  	}
  	if (preg_match('/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/', $to, $m)) {
  		$to = $m[3].'-'.$m[2].'-'.$m[1];
  	}
  	$from = new DateTime($from);
  	$to = new DateTime($to);
  	$this->from = clone $from;
  	$this->to = clone $to;
  	$this->devise = $request->getParameter('devise', 1);
  	$this->client = ($cId = $request->getParameter('client'))? ClientTable::getInstance()->find($cId) : null;
  	$this->fournisseur = ($fId = $request->getParameter('fournisseur'))? FournisseurTable::getInstance()->find($fId) : null;
  	$this->commercial = ($this->commercialId)? CommercialTable::getInstance()->find($this->commercialId) : null;
  	$this->clientId = null;
  	$this->fournisseurId = null;

  	$this->parameters = array('from' => $this->from->format('Y-m-d'), 'to' => $this->to->format('Y-m-d'), 'devise' => $this->device, 'saison' => $this->saison, 'commercial' => $this->commercialId, 'produit' => $this->produit);
  	if ($this->client) {
  		$this->clientId = $this->client->getId();
  		$this->parameters = array_merge($this->parameters, array('client' => $this->clientId));
  	}
  	if ($this->fournisseur) {
  		$this->fournisseurId = $this->fournisseur->getId();
  		$this->parameters = array_merge($this->parameters, array('fournisseur' => $this->fournisseurId));
  	}

  	$this->activitePeriode = new Activite($from->format('Y-m-d'), $to->format('Y-m-d'), $this->saison, $this->commercialId, $this->produit);
  	$from->modify('-1 year');
  	$to->modify('-1 year');
  	$this->activitePeriode1 = new Activite($from->format('Y-m-d'), $to->format('Y-m-d'), ($this->saison)? $this->saison - 2 : null, $this->commercialId, $this->produit);
  	$from->modify('-1 year');
  	$to->modify('-1 year');
  	$this->activitePeriode2 = new Activite($from->format('Y-m-d'), $to->format('Y-m-d'), ($this->saison)? $this->saison - 4 : null, $this->commercialId, $this->produit);
  	$this->activiteAnnuel = new Activite($this->from->format('Y').'-01-01', $this->from->format('Y').'-12-31', $this->saison, $this->commercialId, $this->produit);
  	$this->activiteAnnuel1 = new Activite(($this->from->format('Y')-1).'-01-01', ($this->from->format('Y')-1).'-12-31', ($this->saison)? $this->saison - 2 : null, $this->commercialId, $this->produit);
  	$this->activiteAnnuel2 = new Activite(($this->from->format('Y')-2).'-01-01', ($this->from->format('Y')-2).'-12-31', ($this->saison)? $this->saison - 4 : null, $this->commercialId, $this->produit);

  	$this->detailsLink = null;
  	if ($this->client && !$this->fournisseur) {
  		$this->detailsLink = 'fournisseur';
  	}
  	if (!$this->client && $this->fournisseur) {
  		$this->detailsLink = 'client';
  	}
    if ($this->commercial && !$this->client && !$this->fournisseur) {
  		$this->detailsLink = 'client';
  	}
  }


  public function executeRapports(sfWebRequest $request)
  {
  	$from = ($request->getParameter('from'))? $request->getParameter('from') : date('Y').'-01-01';
  	$to = ($request->getParameter('to'))? $request->getParameter('to') : date('Y-m-d');
  	$this->saison = ($request->getParameter('saison'))? $request->getParameter('saison') : null;
  	$this->commercialId = ($request->getParameter('commercial'))? $request->getParameter('commercial') : null;
  	$this->produit = ($request->getParameter('produit'))? $request->getParameter('produit') : null;
    $this->type = $request->getParameter('type');
  	if (preg_match('/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/', $from, $m)) {
  		$from = $m[3].'-'.$m[2].'-'.$m[1];
  	}
  	if (preg_match('/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/', $to, $m)) {
  		$to = $m[3].'-'.$m[2].'-'.$m[1];
  	}
  	$from = new DateTime($from);
  	$to = new DateTime($to);
  	$this->from = clone $from;
  	$this->to = clone $to;
  	$this->devise = $request->getParameter('devise', 1);

  	$this->client = ($cId = $request->getParameter('client'))? ClientTable::getInstance()->find($cId) : null;
  	$this->fournisseur = ($fId = $request->getParameter('fournisseur'))? FournisseurTable::getInstance()->find($fId) : null;
    $this->commercial = ($this->commercialId)? CommercialTable::getInstance()->find($this->commercialId) : null;

    if($this->commercial && !$this->client && !$this->fournisseur && $request->getParameter('type') == 'fournisseur') {
        $this->items = FournisseurTable::getInstance()->findByParameters(array('saison' => $this->saison, 'commercial' => $this->commercialId, 'from' => $this->from->format('Y-m-d'), 'to' => $this->to->format('Y-m-d')));
    } elseif($this->commercial && !$this->client && !$this->fournisseur && $request->getParameter('type') == 'client') {
        $this->items = ClientTable::getInstance()->findByParameters(array('saison' => $this->saison, 'commercial' => $this->commercialId, 'from' => $this->from->format('Y-m-d'), 'to' => $this->to->format('Y-m-d')));
    } elseif($this->fournisseur) {
        $this->items = ClientTable::getInstance()->findByParameters(array('fournisseur' => $fId, 'saison' => $this->saison, 'commercial' => $this->commercialId, 'from' => $this->from->format('Y-m-d'), 'to' => $this->to->format('Y-m-d')));
    } elseif($this->client) {
        $this->items = FournisseurTable::getInstance()->findByParameters(array('client' => $this->client->getId(), 'saison' => $this->saison, 'commercial' => $this->commercialId, 'from' => $this->from->format('Y-m-d'), 'to' => $this->to->format('Y-m-d')));
    } else {
        $this->items = ClientTable::getInstance()->findByParameters(array('saison' => $this->saison, 'commercial' => $this->commercialId, 'from' => $this->from->format('Y-m-d'), 'to' => $this->to->format('Y-m-d')));
    }

  	$this->parameters = array('from' => $this->from->format('Y-m-d'), 'to' => $this->to->format('Y-m-d'), 'devise' => $this->device, 'saison' => $this->saison, 'commercial' => $this->commercialId, 'produit' => $this->produit);
  	if ($this->client) {
  		$this->parameters = array_merge($this->parameters, array('client' => $this->client->getId()));
  	}
  	if ($this->fournisseur) {
  		$this->parameters = array_merge($this->parameters, array('fournisseur' => $this->fournisseur->getId()));
  	}

    if($this->type) {
        $this->parameters = array_merge($this->parameters, array('type' => $this->type));
    }

  	$this->activitePeriode = new Activite($from->format('Y-m-d'), $to->format('Y-m-d'), $this->saison, $this->commercialId, $this->produit);
  	$from->modify('-1 year');
  	$to->modify('-1 year');
  	$this->activitePeriode1 = new Activite($from->format('Y-m-d'), $to->format('Y-m-d'), ($this->saison)? $this->saison - 2 : null, $this->commercialId, $this->produit);
  	$from->modify('-1 year');
  	$to->modify('-1 year');
  	$this->activitePeriode2 = new Activite($from->format('Y-m-d'), $to->format('Y-m-d'), ($this->saison)? $this->saison - 4 : null, $this->commercialId, $this->produit);

  	$this->activiteAnnuel = new Activite($this->from->format('Y').'-01-01', $this->from->format('Y').'-12-31', $this->saison, $this->commercialId, $this->produit);
  	$this->activiteAnnuel1 = new Activite(($this->from->format('Y')-1).'-01-01', ($this->from->format('Y')-1).'-12-31', ($this->saison)? $this->saison - 2 : null, $this->commercialId, $this->produit);
  	$this->activiteAnnuel2 = new Activite(($this->from->format('Y')-2).'-01-01', ($this->from->format('Y')-2).'-12-31', ($this->saison)? $this->saison - 4 : null, $this->commercialId, $this->produit);

  	$this->detailsLink = null;
  }



  public function executeClientContentModal(sfWebRequest $request)
  {
  	$this->forward404Unless($request->isXmlHttpRequest());
  	$this->parameters = $request->getGetParameter('parameters', array());
  	$this->fournisseur = (isset($this->parameters['fournisseur']) && !empty($this->parameters['fournisseur']))? FournisseurTable::getInstance()->find($this->parameters['fournisseur']) : null;
  	$this->commercial = (isset($this->parameters['commercial']) && !empty($this->parameters['commercial']))? CommercialTable::getInstance()->find($this->parameters['commercial']) : null;
  	$this->items = ClientTable::getInstance()->findFavorites($this->parameters);
  	$this->itemsAll = ClientTable::getInstance()->findByParameters($this->parameters);
  	$this->type = 'client';
  	$this->setTemplate('contentModal');
  }
  
  public function executeFournisseurContentModal(sfWebRequest $request)
  {
  	$this->forward404Unless($request->isXmlHttpRequest());
  	$this->parameters = $request->getGetParameter('parameters', array());
  	$this->client = (isset($this->parameters['client']) && !empty($this->parameters['client']))? ClientTable::getInstance()->find($this->parameters['client']) : null;
    $this->commercial = (isset($this->parameters['commercial']) && !empty($this->parameters['commercial']))? CommercialTable::getInstance()->find($this->parameters['commercial']) : null;
  	$this->items = FournisseurTable::getInstance()->findFavorites($this->parameters);
  	$this->itemsAll = FournisseurTable::getInstance()->findByParameters($this->parameters);
  	$this->type = 'fournisseur';
  	$this->setTemplate('contentModal');
  }

  public function executeCommercialContentModal(sfWebRequest $request)
  {
  	$this->forward404Unless($request->isXmlHttpRequest());
  	$this->parameters = $request->getGetParameter('parameters', array());
  	$this->client = (isset($this->parameters['client']) && !empty($this->parameters['client']))? ClientTable::getInstance()->find($this->parameters['client']) : null;
  	$this->items = CommercialTable::getInstance()->findFavorites($this->parameters);
  	$this->itemsAll = CommercialTable::getInstance()->findByParameters($this->parameters);
  	$this->type = 'commercial';
  	$this->setTemplate('contentModal');
  }



  public function executeClient(sfWebRequest $request)
  {
  	$from = new DateTime($request->getGetParameter('from'));
  	$to = new DateTime($request->getGetParameter('to'));
    $toAnnuel = new DateTime($request->getGetParameter('to'));
    
    $this->printFrom = $from->format('d/m/Y');
    $this->printTo = $to->format('d/m/Y');
  	
    $this->toAnnuel = $toAnnuel->format('Y');
    
    $activitePeriode = new Activite($from->format('Y-m-d'), $to->format('Y-m-d'));
    $from->modify('-1 year');
    $to->modify('-1 year');
    $activitePeriode1 = new Activite($from->format('Y-m-d'), $to->format('Y-m-d'));
    $from->modify('-1 year');
    $to->modify('-1 year');
    $activitePeriode2 = new Activite($from->format('Y-m-d'), $to->format('Y-m-d'));
  	
  	$this->activitePeriode = $activitePeriode->getMontantByClient();
  	$this->activitePeriode1 = $activitePeriode1->getMontantByClient();
  	$this->activitePeriode2 = $activitePeriode2->getMontantByClient();
    
    $activiteAnnuel = new Activite($toAnnuel->format('Y').'-01-01', $toAnnuel->format('Y-m-d'));
    $toAnnuel->modify('-1 year');
    $activiteAnnuel1 = new Activite($toAnnuel->format('Y').'-01-01', $toAnnuel->format('Y').'-12-31');
    $toAnnuel->modify('-1 year');
    $activiteAnnuel2 = new Activite($toAnnuel->format('Y').'-01-01', $toAnnuel->format('Y').'-12-31');
    
    $this->activiteAnnuel = $activiteAnnuel->getMontantByClient();
    $this->activiteAnnuel1 = $activiteAnnuel1->getMontantByClient();
    $this->activiteAnnuel2 = $activiteAnnuel2->getMontantByClient();
  	
  }
  

  
  public function executeGlobal(sfWebRequest $request)
  {
  	$from = new DateTime($request->getGetParameter('from'));
  	$to = new DateTime($request->getGetParameter('to'));
    $toAnnuel = new DateTime($request->getGetParameter('to'));
    
    $activitePeriode = new Activite($from->format('Y-m-d'), $to->format('Y-m-d'));
    $from->modify('-1 year');
    $to->modify('-1 year');
    $activitePeriode1 = new Activite($from->format('Y-m-d'), $to->format('Y-m-d'));
    $from->modify('-1 year');
    $to->modify('-1 year');
    $activitePeriode2 = new Activite($from->format('Y-m-d'), $to->format('Y-m-d'));
  	
  	$ap = $activitePeriode->getMontantByGlobal();
  	$ap1 = $activitePeriode1->getMontantByGlobal();
  	$ap2 = $activitePeriode2->getMontantByGlobal();
    
    $activiteAnnuel = new Activite($toAnnuel->format('Y').'-01-01', $toAnnuel->format('Y-m-d'));
    $toAnnuel->modify('-1 year');
    $activiteAnnuel1 = new Activite($toAnnuel->format('Y').'-01-01', $toAnnuel->format('Y').'-12-31');
    $toAnnuel->modify('-1 year');
    $activiteAnnuel2 = new Activite($toAnnuel->format('Y').'-01-01', $toAnnuel->format('Y').'-12-31');
    
    $aa = $activiteAnnuel->getMontantByGlobal();
    $aa1 = $activiteAnnuel1->getMontantByGlobal();
    $aa2 = $activiteAnnuel2->getMontantByGlobal();
    
    $result = 'Saison;Client;Fournisseur;Qualite;Metrage;Cumul periode;Cumul periode (N-1);% mensuel;Cumul annuel;Cumul annuel (N-1);% annuel;Cumul période (N-2);Cumul annuel (N-2)';
    $result .= "\n";
    foreach ($ap as $id => $apitem) {
    	$totalPrix = $apitem['total'];
    	$totalPrix += (isset($ap1[$id]['total']))? $ap1[$id]['total'] : 0; 
    	$totalPrix += (isset($aa[$id]['total']))? $aa[$id]['total'] : 0;
    	$totalPrix += (isset($aa1[$id]['total']))? $aa1[$id]['total'] : 0;
    	$totalPrix += (isset($ap2[$id]['total']))? $ap2[$id]['total'] : 0;
    	$totalPrix += (isset($aa2[$id]['total']))? $aa2[$id]['total'] : 0;
    	if (!$totalPrix) {
    		continue;
    	}
    	$result .= $apitem['saison'];
    	$result .= ';';
    	$result .= $apitem['client'];
    	$result .= ';';
    	$result .= $apitem['fournisseur'];
    	$result .= ';';
    	$result .= $apitem['qualite'];
    	$result .= ';';
    	$result .= $apitem['metrage'];
    	$result .= ';';
    	$result .= number_format($apitem['total'], 2, ',', ' ');
    	$result .= ';';
    	$result .= (isset($ap1[$id]))? number_format($ap1[$id]['total'], 2, ',', ' ') : '';
    	$result .= ';';
    	if (isset($ap1[$id]) && $ap1[$id]['total'] > 0) {
    		$diff = $apitem['total'] / $ap1[$id]['total']; 
    		if ($diff > 1) { 
    			$result .= '+'.number_format(($diff - 1) * 100, 2, ',', ' ').'%'; 
    		} else { 
    			$result .= '-'.number_format($diff * 100, 2, ',', ' ').'%'; 
    		}
    	} else {
    		$result .= '';
    	}
    	$result .= ';';
    	$result .= (isset($aa[$id]))? number_format($aa[$id]['total'], 2, ',', ' ') : '';
    	$result .= ';';
    	$result .= (isset($aa1[$id]))? number_format($aa1[$id]['total'], 2, ',', ' ') : '';
    	$result .= ';';
    	if (isset($aa1[$id]) && $aa1[$id]['total'] > 0) {
    		$diff = $apitem['total'] / $aa1[$id]['total']; 
    		if ($diff > 1) { 
    			$result .= '+'.number_format(($diff - 1) * 100, 2, ',', ' ').'%'; 
    		} else { 
    			$result .= '-'.number_format($diff * 100, 2, ',', ' ').'%'; 
    		}
    	} else {
    		$result .= '';
    	}
    	$result .= ';';
    	$result .= (isset($ap2[$id]))? number_format($ap2[$id]['total'], 2, ',', ' ') : '';
    	$result .= ';';
    	$result .= (isset($aa2[$id]))? number_format($aa2[$id]['total'], 2, ',', ' ') : '';
    	$result .= "\n";
    	
    }
    	mb_convert_encoding($result, 'UTF-16LE', 'UTF-8');
    	
        $this->getResponse()->setContentType('application/csv');
        $this->getResponse()->setHttpHeader('Content-disposition', 'filename=commercial_activity_rapport_global.csv', true);
        $this->getResponse()->setHttpHeader('Pragma', 'o-cache', true);
        $this->getResponse()->setHttpHeader('Expires', '0', true);
        
        return $this->renderText($result);
  }
}
