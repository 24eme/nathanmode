<?php

/**
 * Client filter form.
 *
 * @package    nathanmode
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ClientFormFilter extends BaseClientFormFilter
{
  public function configure()
  {
  	$this->getWidget('telephone')->setOption('with_empty', false);
  	$this->getWidget('adresse_livraison')->setOption('with_empty', false);
  	$this->getWidget('code_postal_livraison')->setOption('with_empty', false);
  	$this->getWidget('ville_livraison')->setOption('with_empty', false);
  	$this->setWidget('condition_paiement', new sfWidgetFormChoice(array('choices' => $this->getConditionsPaiement())));
  	$this->setValidator('condition_paiement', new sfValidatorChoice(array('required' => false, 'choices' => array_keys($this->getConditionsPaiement()))));



    $this->setWidget('id', new sfWidgetFormFilterInput());
  	$this->getWidget('id')->setOption('with_empty', false);
    $this->setValidator('id', new sfValidatorPass(array('required' => false)));
  }
  public function getConditionsPaiement() {
  	return array_merge(array('' => ''), ConditionsPaiement::getListe());
  }

  public function addConditionPaiementColumnQuery($query, $field, $values) {
        $this->addEnumQuery($query, $field, $values);
  }
}
