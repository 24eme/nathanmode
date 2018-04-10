<?php

/**
 * Facture filter form.
 *
 * @package    nathanmode
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FactureFormFilter extends BaseFactureFormFilter
{
  /**
   * @see BonFormFilter
   */
  public function configure()
  {
    parent::configure();
    $this->setWidget('date', 
  		new sfWidgetFormFilterDate(
  			array(
  				'from_date' => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%')), 
  				'to_date' => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%')),
  				'template' => 'du %from_date%<br />au %to_date%'
  			)
  		)
  	);
  	$this->setWidget('montant', new WidgetFormInputDisabled());
  	$this->setValidator('montant', new sfValidatorPass(array('required' => false)));
  	$this->setWidget('total_fournisseur', new WidgetFormInputDisabled());
  	$this->setValidator('total_fournisseur', new sfValidatorPass(array('required' => false)));
  	$this->setWidget('total_commercial', new WidgetFormInputDisabled());
  	$this->setValidator('total_commercial', new sfValidatorPass(array('required' => false)));
  	$this->setWidget('fichier', new WidgetFormInputDisabled());
  	$this->setValidator('fichier', new sfValidatorPass(array('required' => false)));
  	$this->setWidget('statut', new sfWidgetFormChoice(array('choices' => $this->getStatuts(), 'multiple' => false)));
  	
  	$this->getWidget('date')->setOption('with_empty', false);
  	$this->getWidget('relation')->setOption('with_empty', false);
  	$this->getWidget('numero')->setOption('with_empty', false);
  }


    public function getStatuts() {
		$list = StatutsFacture::getListe();
		$emptyValue = array('' => ' ');
		$statuts = array_merge($emptyValue, $list);
		return $statuts; 
    }
  
  public function addStatutColumnQuery($query, $field, $values) {
        $this->addEnumQuery($query, $field, $values);
  }
}
