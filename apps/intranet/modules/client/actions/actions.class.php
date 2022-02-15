<?php

require_once dirname(__FILE__).'/../lib/clientGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/clientGeneratorHelper.class.php';

/**
 * client actions.
 *
 * @package    nathanmode
 * @subpackage client
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class clientActions extends autoClientActions
{

  public function executeGetpaiement(sfWebRequest $request)
  {
    $this->forward404Unless($request->isXmlHttpRequest());
    $client = $this->getRoute()->getObject();
    echo '{"paiement":"'.$client->getConditionPaiement().'"}';
    return sfView::NONE;
  }
}
