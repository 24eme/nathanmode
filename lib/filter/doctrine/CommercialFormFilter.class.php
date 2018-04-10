<?php

/**
 * Commercial filter form.
 *
 * @package    nathanmode
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CommercialFormFilter extends BaseCommercialFormFilter
{
  public function configure()
  {
  	$this->getWidget('prenom')->setOption('with_empty', false);
  	$this->getWidget('email')->setOption('with_empty', false);
  	$this->getWidget('telephone')->setOption('with_empty', false);
  	$this->getWidget('commission')->setOption('with_empty', false);
  }
}
