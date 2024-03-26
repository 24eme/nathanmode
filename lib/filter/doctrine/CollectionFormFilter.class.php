<?php

/**
 * Collection filter form.
 *
 * @package    nathanmode
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CollectionFormFilter extends BaseCollectionFormFilter
{
  public function configure()
  {
  	$this->setWidget('date_commande', 
  		new sfWidgetFormFilterDate(
  			array(
  				'from_date' => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%')), 
  				'to_date' => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%')),
  				'template' => 'du %from_date%<br />au %to_date%'
  			)
  		)
  	);
  	$this->setWidget('date_livraison', 
  		new sfWidgetFormFilterDate(
  			array(
  				'from_date' => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%')), 
  				'to_date' => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%')),
  				'template' => 'du %from_date%<br />au %to_date%'
  			)
  		)
  	);
  	$this->setWidget('date_retard', new WidgetFormInputDisabled());
  	$this->setValidator('date_retard', new sfValidatorPass(array('required' => false)));
  	$this->setWidget('ecrus', new WidgetFormInputDisabled());
  	$this->setValidator('ecrus', new sfValidatorPass(array('required' => false)));
  	$this->setWidget('situation', new sfWidgetFormChoice(array('choices' => $this->getSituations(), 'multiple' => false)));
  	$this->setWidget('qualite', new sfWidgetFormChoice(array('choices' => $this->getQualites(), 'multiple' => false)));
  	 $this->setValidator('paiement', new sfValidatorChoice(
            array('choices' => array_keys($this->getSituations()),
                  'required' => false,
            	  'multiple' => true
                )
            ));
    $this->getWidget('date_commande')->setOption('with_empty', false);
    $this->getWidget('num_commande')->setOption('with_empty', false);
    $this->getWidget('date_livraison')->setOption('with_empty', false);
    $this->getWidget('nb_relance')->setOption('with_empty', false);
    $this->getWidget('reste_a_livrer')->setOption('with_empty', false);
  }


    public function getSituations() {
		$list = Situations::getListe();
		$emptyValue = array('' => ' ');
		$situations = array_merge($emptyValue, $list);
		return $situations; 
    }


    public function getQualites() {
  		$list = CollectionTable::getInstance()->getQualites();
      $result = array('' => ' ');
      foreach ($list as $val) {
        $result[$val['qualite']] = $val['qualite'];
      }
  		return $result;
    }
  
  public function addSituationColumnQuery($query, $field, $values) {
        $this->addEnumQuery($query, $field, $values);
  }
  
  public function addQualiteColumnQuery($query, $field, $values) {
        $this->addEnumQuery($query, $field, $values);
  }
}
