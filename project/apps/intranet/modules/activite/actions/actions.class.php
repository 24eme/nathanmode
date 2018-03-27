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
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->filters = new ActiviteFormFilter();
    
    $from = new DateTime(date('Y').'-01-01');
    $this->to = $to = new DateTime(date('Y-m-d'));
    $toAnnuel = new DateTime(date('Y-m-d'));
    
    if ($request->isMethod('post')) {
    	$this->filters->bind($request->getParameter($this->filters->getName()));
	    if ($this->filters->isValid()) {
	    	$values = $this->filters->getValues();
	    	$fromValue = explode('/', $values['from']);
	    	$toValue = explode('/', $values['to']);
	  		$from->setDate($fromValue[2], $fromValue[1], $fromValue[0]);
	  		$to->setDate($toValue[2], $toValue[1], $toValue[0]);
    		$toAnnuel->setDate($toValue[2], $toValue[1], $toValue[0]);
	  	}
    }
    
    $this->toAnnuel = $toAnnuel->format('Y');
    
    $this->linkfrom = $from->format('Y-m-d');
    $this->linkto = $to->format('Y-m-d');
    
    $activitePeriode = new Activite($from->format('Y-m-d'), $to->format('Y-m-d'));
    $from->modify('-1 year');
    $to->modify('-1 year');
    $activitePeriode1 = new Activite($from->format('Y-m-d'), $to->format('Y-m-d'));
    $from->modify('-1 year');
    $to->modify('-1 year');
    $activitePeriode2 = new Activite($from->format('Y-m-d'), $to->format('Y-m-d'));
    
    $this->activitePeriode = $activitePeriode->getMontant();
    $this->activitePeriode1 = $activitePeriode1->getMontant();
    $this->activitePeriode2 = $activitePeriode2->getMontant();
    
    $this->activitePeriodeDoll = $activitePeriode->getMontant(2);
    $this->activitePeriode1Doll = $activitePeriode1->getMontant(2);
    $this->activitePeriode2Doll = $activitePeriode2->getMontant(2);
    
    $this->activitePeriodeCom = $activitePeriode->getCom();
    $this->activitePeriode1Com = $activitePeriode1->getCom();
    $this->activitePeriode2Com = $activitePeriode2->getCom();
    
    $this->activitePeriodeDollCom = $activitePeriode->getCom(2);
    $this->activitePeriode1DollCom = $activitePeriode1->getCom(2);
    $this->activitePeriode2DollCom = $activitePeriode2->getCom(2);
    
    $this->activitePeriodeMts = $activitePeriode->getMts();
    $this->activitePeriode1Mts = $activitePeriode1->getMts();
    $this->activitePeriode2Mts = $activitePeriode2->getMts();
    
    $this->activitePeriodeDollMts = $activitePeriode->getMts(2);
    $this->activitePeriode1DollMts = $activitePeriode1->getMts(2);
    $this->activitePeriode2DollMts = $activitePeriode2->getMts(2);
    
    $activiteAnnuel = new Activite($toAnnuel->format('Y').'-01-01', $toAnnuel->format('Y-m-d'));
    $toAnnuel->modify('-1 year');
    $activiteAnnuel1 = new Activite($toAnnuel->format('Y').'-01-01', $toAnnuel->format('Y').'-12-31');
    $toAnnuel->modify('-1 year');
    $activiteAnnuel2 = new Activite($toAnnuel->format('Y').'-01-01', $toAnnuel->format('Y').'-12-31');
    
    $this->activiteAnnuel = $activiteAnnuel->getMontant();
    $this->activiteAnnuel1 = $activiteAnnuel1->getMontant();
    $this->activiteAnnuel2 = $activiteAnnuel2->getMontant();
    
    $this->activiteAnnuelDoll = $activiteAnnuel->getMontant(2);
    $this->activiteAnnuel1Doll = $activiteAnnuel1->getMontant(2);
    $this->activiteAnnuel2Doll = $activiteAnnuel2->getMontant(2);
    
    $this->activiteAnnuelCom = $activiteAnnuel->getCom();
    $this->activiteAnnuel1Com = $activiteAnnuel1->getCom();
    $this->activiteAnnuel2Com = $activiteAnnuel2->getCom();
    
    $this->activiteAnnuelDollCom = $activiteAnnuel->getCom(2);
    $this->activiteAnnuel1DollCom = $activiteAnnuel1->getCom(2);
    $this->activiteAnnuel2DollCom = $activiteAnnuel2->getCom(2);
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
