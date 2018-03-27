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
	
	public function executePaiement(sfWebRequest $request)
	{
		$this->client = ClientTable::getInstance()->find($request->getParameter('id'));
		echo $this->client->getConditionPaiement();
		return sfView::NONE;
	}
}
