<?php

/**
 * CollectionLivraison form.
 *
 * @package    nathanmode
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CollectionLivraisonForm extends BaseCollectionLivraisonForm
{
    public function configure()
    {
        $this->useFields(array('devise_id',
        					   'colori',
                     'piece_categorie',
                     'piece',
          					 'prix',
          					 'escompte',
          					 'escompte_devise_id',
                     'adresse_livraison',
                     'date',
                     'num_facture',
                     'fichier',
                     'packing_list'));

        $this->setWidget('date', new WidgetFormInputDate());
        $this->setValidator('date', new sfValidatorDate(array('required' => false)));


        $this->setWidget('fichier', new sfWidgetFormInputFileEditable(array(
                                                                      'file_src' => FactureTable::getInstance()->getUploadPath(false).$this->getObject()->fichier,
                                                                       'edit_mode' => $this->getObject()->fichier,
                                                                       'template' => '%input%<br />%delete% Suppr. le fichier<a href="%file%" target="_blank">Voir le fichier</a>'
                                                                    )));
        $this->setValidator('fichier', new sfValidatorFile(
            array('required' => $this->getValidator('fichier')->getOption('required'),
                  'path' => FactureTable::getInstance()->getUploadPath(true))
            ));


        $this->setWidget('packing_list', new sfWidgetFormInputFileEditable(array(
                                                                      'file_src' => CollectionLivraisonTable::getInstance()->getUploadPath(false).$this->getObject()->packing_list,
                                                                       'edit_mode' => $this->getObject()->packing_list,
                                                                       'template' => '%input%<br />%delete% Suppr. le fichier<a href="%file%" target="_blank">Voir le fichier</a>'
                                                                    )));
        $this->setValidator('packing_list', new sfValidatorFile(
            array('required' => $this->getValidator('packing_list')->getOption('required'),
                  'path' => CollectionLivraisonTable::getInstance()->getUploadPath(true))
            ));

        $this->setValidator('fichier_delete', new sfValidatorPass());
        $this->setValidator('packing_list_delete', new sfValidatorPass());

        $this->setWidget('piece_categorie', new sfWidgetFormInputHidden());
        $this->setValidator('piece_categorie', new sfValidatorPass(array('required' => false)));

        $this->setWidget('devise_id', new sfWidgetFormInputHidden());
        $this->setValidator('devise_id', new sfValidatorPass(array('required' => false)));

        $this->getWidgetSchema()->setLabels(array(
          'colori' => 'Colori',
          'devise_id' => 'Devise',
          'escompte_devise_id' => 'Escompte devise',
          'piece' => 'Quantité',
          'prix' => 'Prix',
          'escompte' => 'Escompte',
          'adresse_livraison' => 'Adresse de livraison',
          'date' => 'Date',
          'num_facture' => 'Facture n°',
          'fichier' => 'Joindre',
          'packing_list' => 'Packing list',
        ));
        $this->getWidget('prix')->setAttribute('class', 'input-float');
    }


    protected function doUpdateObject($values)
    {
    	if (!$values['escompte']) {
    		$values['escompte'] = 0.00;
    	}
      if($values['piece_categorie'] == "METRAGE") {
          $values['metrage'] = $values['piece'];
          $values['piece_categorie'] = null;
          $values['piece'] = null;
      } else {
        $values['metrage'] = null;
      }
    	parent::doUpdateObject($values);
    }

    public function updateDefaultsFromObject() {
      parent::updateDefaultsFromObject();
      if (!$this->getObject()->escompte_devise_id) {
        $this->defaults['escompte_devise_id'] = Devise::POURCENTAGE_ID;
      }
      if ($this->getObject()->metrage) {
        $this->defaults['piece'] = $this->getObject()->metrage;
      }
    }
}
