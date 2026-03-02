<?php

/**
 * CollectionRetard form.
 *
 * @package    nathanmode
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CollectionRetardForm extends BaseCollectionRetardForm
{
    public function configure()
    {
        $this->useFields(array('date',
                               'qualite',
                               'piece_categorie',
                               'colori',
                               'observation'));

        $this->setWidget('date', new WidgetFormInputDate());
        $this->setValidator('date', new sfValidatorDate(array('required' => false)));
        $this->setWidget('observation', new sfWidgetFormTextarea());

        $this->getWidgetSchema()->setLabels(array(
          'date' => 'Date de retard',
          'observation' => 'Observation',
        ));

      	$this->setWidget('piece_categorie', new sfWidgetFormChoice(array('choices' => $this->getPieceCategoriesGrouped())));
        $this->setValidator('piece_categorie', new sfValidatorChoice(array('choices' => array_keys($this->getPieceCategories()),'required' => $this->getValidator('piece_categorie')->getOption('required'))));

        $this->setWidget('piece_categorie_value', new sfWidgetFormInputHidden());
        $this->setValidator('piece_categorie_value', new sfValidatorPass(array('required' => false)));
    }


    protected function doUpdateObject($values)
    {
      $values['piece_categorie'] = $values['piece_categorie_value'];
      if($values['piece_categorie'] == "METRAGE" && !sfConfig::get('app_no_metrage')) {
          $values['piece_categorie'] = null;
      }
    	parent::doUpdateObject($values);
    }

    public function updateDefaultsFromObject() {
      parent::updateDefaultsFromObject();
      if(!sfConfig::get('app_no_metrage') && !$this->getObject()->piece_categorie) {
          $this->defaults['piece_categorie'] = "METRAGE";
      }
      $this->defaults['piece_categorie_value'] = $this->defaults['piece_categorie'];
    }

    public function getPieceCategories() {
        $liste = PieceCategories::getListe();
        if($this->getObject()->piece_categorie && !array_key_exists($this->getObject()->piece_categorie, PieceCategories::getListe())) {
            $liste[$this->getObject()->piece_categorie] = $this->getObject()->piece_categorie;
        }

        return $liste;
    }


    public function getPieceCategoriesGrouped() {
        $groupedListe = PieceCategories::getGroupedListe(sfConfig::get('app_no_metrage'));

        if($this->getObject()->piece_categorie && !array_key_exists($this->getObject()->piece_categorie, PieceCategories::getListe())) {
            $groupedListe[$this->getObject()->piece_categorie] = $this->getObject()->piece_categorie;
        }

        return $groupedListe;
    }
}
