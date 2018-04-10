<?php

require_once dirname(__FILE__).'/../lib/coupeGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/coupeGeneratorHelper.class.php';

/**
 * coupe actions.
 *
 * @package    nathanmode
 * @subpackage coupe
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class coupeActions extends autoCoupeActions
{protected function buildQuery()
  {
    $query = parent::buildQuery();
    $rootAlias = $query->getRootAlias();
    $query->leftJoin($rootAlias.'.Fournisseur f')
    	  ->leftJoin($rootAlias.'.Saison s')
    	  ->leftJoin($rootAlias.'.Client cl')
    	  ->leftJoin($rootAlias.'.Facture fa')
    	  ->leftJoin($rootAlias.'.Commercial co');
   return $query;
    
  }
}
