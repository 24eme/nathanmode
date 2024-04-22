<?php

/**
 * Coupe filter form.
 *
 * @package    nathanmode
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CoupeFormFilter extends BaseCoupeFormFilter
{
  public function configure()
  {

  	$this->setWidget('date_commande',
  		new sfWidgetFormFilterDate(
  			array(
                'from_date' => new sfWidgetFormInput(array('type' => 'date')),
   				'to_date' => new sfWidgetFormInput(array('type' => 'date')),
  				'template' => 'du %from_date%<br />au %to_date%'
  			)
  		)
  	);
  	$this->setWidget('livre_le',
  		new sfWidgetFormFilterDate(
  			array(
  				'from_date' => new sfWidgetFormInput(array('type' => 'date')),
  				'to_date' => new sfWidgetFormInput(array('type' => 'date')),
  				'template' => 'du %from_date%<br />au %to_date%'
  			)
  		)
  	);
  	$this->setWidget('date_livraison', 
  		new sfWidgetFormFilterDate(
  			array(
                'from_date' => new sfWidgetFormInput(array('type' => 'date')),
   				'to_date' => new sfWidgetFormInput(array('type' => 'date')),
  				'template' => 'du %from_date%<br />au %to_date%'
  			)
  		)
  	);

    $this->setWidget('situation', new sfWidgetFormChoice(array('choices' => array_merge(array('' => ' '), CoupeForm::getSituations()), 'multiple' => false)));
    $this->setWidget('tissu', new sfWidgetFormChoice(array('choices' => $this->getTissus(), 'multiple' => false)));

  	$this->getWidget('colori')->setOption('with_empty', false);
  	$this->getWidget('metrage')->setOption('with_empty', false);
  	$this->getWidget('date_commande')->setOption('with_empty', false);
  	$this->getWidget('date_livraison')->setOption('with_empty', false);
  	$this->getWidget('livre_le')->setOption('with_empty', false);
    $this->getWidget('nb_relance')->setOption('with_empty', false);
    $this->getWidget('prix')->setOption('with_empty', false);
    $this->getWidget('num_facture')->setOption('with_empty', false);

    $this->getWidget('fichier')->setOption('template', '%empty_checkbox% %empty_label%');
    $this->getWidget('fichier_confirmation')->setOption('template', '%empty_checkbox% %empty_label%');

    $this->setWidget('piece_categorie', new sfWidgetFormChoice(array('choices' => $this->getPieceCategories(), 'multiple' => false)));

  }

  public function getPieceCategories() {
    $list = PieceCategories::getListe();
    $emptyValue = array('' => ' ');
    $piece_categories = array_merge($emptyValue, $list);
    return $piece_categories;
  }

  public function addPieceCategorieColumnQuery($query, $field, $values) {
        $this->addEnumQuery($query, $field, $values);
  }

  public function addSituationColumnQuery($query, $field, $values) {
        $this->addEnumQuery($query, $field, $values);
      }


  public function getTissus() {
    $list = CoupeTable::getInstance()->getTissus();
    $result = array('' => ' ');
    foreach ($list as $val) {
      $result[$val['tissu']] = $val['tissu'];
    }
    return $result;
  }

  public function addTissuColumnQuery($query, $field, $values) {
        $this->addEnumQuery($query, $field, $values);
  }

}
