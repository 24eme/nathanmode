<?php

require_once dirname(__FILE__).'/../lib/facure_payeeGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/facure_payeeGeneratorHelper.class.php';

/**
 * facure_payee actions.
 *
 * @package    nathanmode
 * @subpackage facure_payee
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class facure_payeeActions extends autoFacure_payeeActions
{


  protected function buildQuery()
  {
    $query = parent::buildQuery();
    $rootAlias = $query->getRootAlias();
    $query->leftJoin($rootAlias.'.Fournisseur f')
    	  ->leftJoin($rootAlias.'.Saison s')
    	  ->leftJoin($rootAlias.'.Client cl')
    	  ->leftJoin($rootAlias.'.Commercial co');
   $query->addWhere($rootAlias.'.statut = ?', StatutsFacture::KEY_PAYEE);
   $query->addWhere('year('.$rootAlias.'.date) != ?', date('Y'));
   $query->addWhere($rootAlias.'.actif = ?', true);
   return $query;
    
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

    $this->redirect('@facture_facure_payee');
  }
}
