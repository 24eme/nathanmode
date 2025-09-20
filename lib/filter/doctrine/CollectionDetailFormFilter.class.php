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
                    'from_date' => new sfWidgetFormDate(array('format' => '%year%-%month%-%day%')),
                    'to_date' => new sfWidgetFormDate(array('format' => '%year%-%month%-%day%')),
                    'template' => 'du %from_date%<br />au %to_date%'
                    )
            ));
        $this->setValidator('date_commande', new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))));
        $this->getWidget('date_commande')->setOption('with_empty', false);


        $this->setWidget('num_commande', new sfWidgetFormFilterInput());
        $this->setValidator('num_commande', new sfValidatorPass(array('required' => false)));
        $this->getWidget('num_commande')->setOption('with_empty', false);


        $this->setWidget('date_livraison',
            new sfWidgetFormFilterDate(
                array(
                    'from_date' => new sfWidgetFormDate(array('format' => '%year%-%month%-%day%')),
                    'to_date' => new sfWidgetFormDate(array('format' => '%year%-%month%-%day%')),
                    'template' => 'du %from_date%<br />au %to_date%'
                )
            ));
        $this->setValidator('date_livraison', new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))));
        $this->getWidget('date_livraison')->setOption('with_empty', false);


        $this->setWidget('situation', new sfWidgetFormChoice(array('choices' => $this->getSituations(), 'multiple' => false)));
        $this->setValidator('situation', new sfValidatorPass(array('required' => false)));

        $this->setWidget('qualite', new sfWidgetFormChoice(array('choices' => $this->getQualites(), 'multiple' => false)));
        $this->setValidator('qualite', new sfValidatorPass(array('required' => false)));

        $this->setWidget('nb_relance', new sfWidgetFormFilterInput());
        $this->setValidator('nb_relance', new sfValidatorPass(array('required' => false)));

        $this->getWidget('piece_categorie')->setOption('with_empty', false);
        $this->getWidget('image')->setOption('with_empty', false);
        $this->getWidget('colori')->setOption('with_empty', false);
        $this->getWidget('piece')->setOption('with_empty', false);
        $this->getWidget('prix')->setOption('with_empty', false);
  }


  public function getSaisons() {
      $saisons = SaisonTable::getInstance()->getListeTriee();
      return ['' => ''] + array_reverse($saisons, true);
  }

  public function addSaisonIdColumnQuery($query, $field, $values) {
      $query->addWhere(sprintf('%s.%s = ?', 'c', 'saison_id'), $values);
  }

  public function getFournisseurs() {
      $fournisseurs = FournisseurTable::getInstance()->getListeTriee();
      asort($fournisseurs);
      return ['' => ''] + $fournisseurs;
  }

  public function addFournisseurIdColumnQuery($query, $field, $values) {
      $query->addWhere(sprintf('%s.%s = ?', 'c', 'fournisseur_id'), $values);
  }

  public function getClients() {
      $clients = ClientTable::getInstance()->getListeTriee();
      asort($clients);
      return ['' => ''] + $clients;
  }

  public function addClientIdColumnQuery($query, $field, $values) {
      $query->addWhere(sprintf('%s.%s = ?', 'c', 'client_id'), $values);
  }

  public function addDateCommandeColumnQuery($query, $field, $values) {
      $query->addWhere(sprintf('%s.%s BETWEEN ? AND ?', 'c', 'date_commande'), array_values($values));
  }

  public function addNumCommandeColumnQuery($query, $field, $values) {
      $query->addWhere(sprintf('%s.%s = ?', 'c', 'num_commande'), array_values($values));
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

}
