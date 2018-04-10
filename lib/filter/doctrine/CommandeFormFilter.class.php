<?php

/**
 * Commande filter form.
 *
 * @package    nathanmode
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CommandeFormFilter extends BaseCommandeFormFilter
{
  public function configure()
  {
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

  	$this->getWidget('colori')->setOption('with_empty', false);
  	$this->getWidget('metrage')->setOption('with_empty', false);
  	$this->getWidget('qualite')->setOption('with_empty', false);
  	$this->getWidget('date')->setOption('with_empty', false);
  	$this->getWidget('relation')->setOption('with_empty', false);
  	$this->getWidget('numero')->setOption('with_empty', false);
  	$this->setWidget('qualite', new sfWidgetFormChoice(array('choices' => $this->getQualites(), 'multiple' => false)));
  }


    public function getQualites() {
		$list = QualiteTable::getInstance()->getTabQualites();
		$emptyValue = array('' => ' ');
		$qualites = array_merge($emptyValue, $list);
		return $qualites; 
    }
  
  public function addQualiteColumnQuery($query, $field, $values) {
        $this->addEnumQuery($query, $field, $values);
  }
}
