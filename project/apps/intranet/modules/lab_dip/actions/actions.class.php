<?php

require_once dirname(__FILE__).'/../lib/lab_dipGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/lab_dipGeneratorHelper.class.php';

/**
 * lab_dip actions.
 *
 * @package    nathanmode
 * @subpackage lab_dip
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class lab_dipActions extends autoLab_dipActions
{protected function buildQuery()
  {
    $query = parent::buildQuery();
    $rootAlias = $query->getRootAlias();
    $query->leftJoin($rootAlias.'.Fournisseur f')
    	  ->leftJoin($rootAlias.'.Saison s')
    	  ->leftJoin($rootAlias.'.Client cl');
   return $query;
    
  }
}
