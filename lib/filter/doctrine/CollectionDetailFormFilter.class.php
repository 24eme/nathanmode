<?php

/**
 * CollectionDetail filter form.
 *
 * @package    nathanmode
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CollectionDetailFormFilter extends BaseCollectionDetailFormFilter
{
  public function configure()
  {

        $this->setWidget('saison_id', new sfWidgetFormChoice(array('choices' => $this->getSaisons(), 'multiple' => false)));
        $this->setValidator('saison_id', new sfValidatorChoice(
                array('choices' => array_keys($this->getSaisons()),
                      'required' => false,
                      'multiple' => false
                    )
            ));

        $this->setWidget('fournisseur_id', new sfWidgetFormChoice(array('choices' => $this->getFournisseurs(), 'multiple' => false)));
        $this->setValidator('fournisseur_id', new sfValidatorChoice(
                array('choices' => array_keys($this->getFournisseurs()),
                    'required' => false,
                    'multiple' => false
                    )
            ));

        $this->setWidget('client_id', new sfWidgetFormChoice(array('choices' => $this->getClients(), 'multiple' => false)));
        $this->setValidator('client_id', new sfValidatorChoice(
                array('choices' => array_keys($this->getClients()),
                    'required' => false,
                    'multiple' => false
                    )
            ));

        $this->setWidget('date_commande',
      		new sfWidgetFormFilterDate(
      			array(
      				'from_date' => new sfWidgetFormInput(array('type' => 'date')),
      				'to_date' => new sfWidgetFormInput(array('type' => 'date')),
      				'template' => 'du %from_date%<br />au %to_date%'
      			)
      		)
      	);

        $this->setValidator('date_commande', new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))));
        $this->getWidget('date_commande')->setOption('with_empty', false);


        $this->setWidget('num_commande', new sfWidgetFormFilterInput());
        $this->setValidator('num_commande', new sfValidatorPass(array('required' => false)));
        $this->getWidget('num_commande')->setOption('with_empty', false);


        $this->setWidget('date_livraison_demandee',
          new sfWidgetFormFilterDate(
            array(
              'from_date' => new sfWidgetFormInput(array('type' => 'date')),
              'to_date' => new sfWidgetFormInput(array('type' => 'date')),
              'template' => 'du %from_date%<br />au %to_date%'
            )
          )
        );
        $this->setValidator('date_livraison_demandee', new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))));
        $this->getWidget('date_livraison_demandee')->setOption('with_empty', false);


        $this->setWidget('piece_categorie', new sfWidgetFormChoice(array('choices' => $this->getPieceCategories(), 'multiple' => false)));
        $this->setValidator('piece_categorie', new sfValidatorPass(array('required' => false)));

        $this->setWidget('situation', new sfWidgetFormChoice(array('choices' => $this->getSituations(), 'multiple' => false)));
        $this->setValidator('situation', new sfValidatorPass(array('required' => false)));

        /*$this->setWidget('qualite', new sfWidgetFormChoice(array('choices' => $this->getQualites(), 'multiple' => false)));
        $this->setValidator('qualite', new sfValidatorPass(array('required' => false)));*/

        $this->setWidget('nb_relance', new sfWidgetFormFilterInput());
        $this->setValidator('nb_relance', new sfValidatorPass(array('required' => false)));

        $this->getWidget('colori')->setOption('with_empty', false);
        $this->getWidget('piece')->setOption('with_empty', false);
        $this->getWidget('prix')->setOption('with_empty', false);
        $this->getWidget('nb_relance')->setOption('with_empty', false);
        $this->getWidget('qualite')->setOption('with_empty', false);

        $this->setWidget('image', new WidgetFormInputDisabled());
      	$this->setValidator('image', new sfValidatorPass(array('required' => false)));
  }


  public function getSaisons() {
      $saisons = SaisonTable::getInstance()->getListeTriee();
      return ['' => ''] + array_reverse($saisons, true);
  }

  public function getFournisseurs() {
      $fournisseurs = FournisseurTable::getInstance()->getListeTriee();
      asort($fournisseurs);
      return ['' => ''] + $fournisseurs;
  }

  public function getClients() {
      $clients = ClientTable::getInstance()->getListeTriee();
      asort($clients);
      return ['' => ''] + $clients;
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

  public function getPieceCategories() {
      return ['' => ''] + PieceCategories::getListe();
  }

  public function addSaisonIdColumnQuery($query, $field, $values)
  {
    $value = $this->extractValue($values);
    if (!$value) return;
    $query->addWhere(sprintf('%s.%s = ?', 's', 'id'), $value);
  }

  public function addFournisseurIdColumnQuery($query, $field, $values)
  {
    $value = $this->extractValue($values);
    if (!$value) return;
    $query->addWhere(sprintf('%s.%s = ?', 'f', 'id'), $value);
  }

  public function addClientIdColumnQuery($query, $field, $values)
  {
    $value = $this->extractValue($values);
    if (!$value) return;
    $query->addWhere(sprintf('%s.%s = ?', 'cl', 'id'), $value);
  }

  public function addSituationColumnQuery($query, $field, $values)
  {
    $value = $this->extractValue($values);
    if (!$value) return;
    $query->addWhere(sprintf('%s = ?', 'situation'), $value);
  }

  public function addPieceCategorieColumnQuery($query, $field, $values)
  {
    $value = $this->extractValue($values);
    if (!$value) return;
    $query->addWhere(sprintf('%s = ?', 'piece_categorie'), $value);
  }

  public function addQualiteColumnQuery($query, $field, $values)
  {
    $value = $this->extractValue($values);
    if (!$value) return;
    $query->addWhere(sprintf('%s = ?', 'qualite'), $value);
  }

  public function addNumCommandeColumnQuery($query, $field, $values)
  {
    $value = $this->extractValue($values);
    if (!$value) return;
    $query->addWhere(sprintf('%s = ?', 'num_commande'), $value);
  }

  public function addColoriColumnQuery($query, $field, $values)
  {
    $value = $this->extractValue($values);
    if (!$value) return;
    $query->addWhere("colori LIKE '%".$value."%'");
  }

  public function addPieceColumnQuery($query, $field, $values)
  {
    $value = $this->extractValue($values);
    if (!$value) return;
    $query->addWhere('(piece = '.$value.' OR metrage = '.$value.')');
  }

  public function addNbRelanceColumnQuery($query, $field, $values)
  {
    $value = $this->extractValue($values);
    if (!$value) return;
    $query->addWhere(sprintf('%s = ?', 'nb_relance'), $value);
  }

  public function addDateCommandeColumnQuery($query, $field, $values)
  {
    if (!isset($values['from'])) return;
    if (!isset($values['to'])) return;
    $query->addWhere(sprintf('%s BETWEEN ? AND ?', 'date_commande'), array_values($values));
  }

  public function addDateLivraisonColumnQuery($query, $field, $values)
  {
    if (!isset($values['from'])) return;
    if (!isset($values['to'])) return;
    $query->addWhere(sprintf('%s BETWEEN ? AND ?', 'date_livraison'), array_values($values));
  }

  private function extractValue($values)
  {
    return (is_array($values))? array_values($values)[0] : $values;
  }

}
