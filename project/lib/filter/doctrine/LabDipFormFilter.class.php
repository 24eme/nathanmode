<?php

/**
 * LabDip filter form.
 *
 * @package    nathanmode
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class LabDipFormFilter extends BaseLabDipFormFilter
{
  public function configure()
  {
  	$this->setWidget('statut', new sfWidgetFormChoice(array('choices' => $this->getStatuts(), 'multiple' => false)));
  	$this->setWidget('date_envoi', new WidgetFormInputDisabled());
  	$this->getWidget('article')->setOption('with_empty', false);
  	$this->getWidget('colori')->setOption('with_empty', false);
  }
    public function getStatuts() {
		$list = StatutsLabDip::getListe();
		$emptyValue = array('' => ' ');
		$statuts = array_merge($emptyValue, $list);
		return $statuts; 		
    }
  
  public function addStatutColumnQuery($query, $field, $values) {
        $this->addEnumQuery($query, $field, $values);
  }
}
