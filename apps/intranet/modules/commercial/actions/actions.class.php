<?php

require_once dirname(__FILE__).'/../lib/commercialGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/commercialGeneratorHelper.class.php';

/**
 * commercial actions.
 *
 * @package    nathanmode
 * @subpackage commercial
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class commercialActions extends autoCommercialActions
{protected function buildQuery()
  {
    $query = parent::buildQuery();
    $rootAlias = $query->getRootAlias();
    $query->leftJoin($rootAlias.'.Devise d');
   return $query;
    
  }
}
