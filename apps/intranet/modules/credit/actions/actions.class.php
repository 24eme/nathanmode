<?php

require_once dirname(__FILE__).'/../lib/creditGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/creditGeneratorHelper.class.php';

/**
 * credit actions.
 *
 * @package    nathanmode
 * @subpackage credit
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class creditActions extends autoCreditActions
{


  protected function buildQuery()
  {
    $query = parent::buildQuery();
    $rootAlias = $query->getRootAlias();
    $query->leftJoin($rootAlias.'.Fournisseur f')
    	  ->leftJoin($rootAlias.'.Saison s')
    	  ->leftJoin($rootAlias.'.Client cl')
    	  ->leftJoin($rootAlias.'.Commercial co');
   return $query;
    
  }
}
