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
                               'metrage',
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
                                                                       'template' => '<a href="%file%" target="_blank">Télécharger le fichier</a><br />%input%<br />%delete% %delete_label%'
                                                                    )));
        $this->setValidator('fichier', new sfValidatorFile(
            array('required' => $this->getValidator('fichier')->getOption('required'), 
                  'path' => FactureTable::getInstance()->getUploadPath(true))
            ));


        $this->setWidget('packing_list', new sfWidgetFormInputFileEditable(array(
                                                                      'file_src' => CollectionLivraisonTable::getInstance()->getUploadPath(false).$this->getObject()->packing_list,
                                                                       'edit_mode' => $this->getObject()->packing_list,
                                                                       'template' => '<a href="%file%" target="_blank">Télécharger le fichier</a><br />%input%<br />%delete% %delete_label%'
                                                                    )));
        $this->setValidator('packing_list', new sfValidatorFile(
            array('required' => $this->getValidator('packing_list')->getOption('required'),
                  'path' => CollectionLivraisonTable::getInstance()->getUploadPath(true))
            ));

        $this->setValidator('fichier_delete', new sfValidatorPass());
        $this->setValidator('packing_list_delete', new sfValidatorPass());

        $this->setWidget('piece_categorie', new sfWidgetFormChoice(array('choices' => $this->getPieceCategories())));
        $this->setValidator('piece_categorie', new sfValidatorChoice(
            array('choices' => array_keys($this->getPieceCategories()),
                  'required' => $this->getValidator('piece_categorie')->getOption('required'),
                )
            ));

        $this->getWidgetSchema()->setLabels(array(
          'colori' => 'Colori',
          'devise_id' => 'Devise;',
          'escompte_devise_id' => 'Escompte devise;',
          'piece_categorie' => 'PF Type',
          'piece' => 'Produit Fini',
          'metrage' => 'Métrage',
          'prix' => 'Prix',
          'escompte' => 'Escompte',
          'adresse_livraison' => 'Adresse de livraison',
          'date' => 'Date',
          'num_facture' => 'Facture n°',
          'fichier' => 'Joindre',
          'packing_list' => 'Packing list',
        ));
        $this->mergePostValidator(new sfValidatorCallback(array('callback' => array($this, 'fctValidatorCallback'))));
    }

    public function getPieceCategories() {

        return array_merge(array("" => ""), PieceCategories::getListe());
    }

    public function fctValidatorCallback($validator, $values, $arguments)
    {
    	if ($values['metrage'] && $values['piece'])
    	{
    		throw new sfValidatorErrorSchema($validator, array('piece' => new sfValidatorError($validator, "Métrage ou pièce")));
    	}
    	return $values;
    }
    

    protected function doUpdateObject($values)
    {
    	if (!$values['escompte']) {
    		$values['escompte'] = 0.00;
    	}
    	parent::doUpdateObject($values);
    }

    public function updateDefaultsFromObject() {
      parent::updateDefaultsFromObject();

      if (!$this->getObject()->escompte_devise_id) {
        $this->defaults['escompte_devise_id'] = Devise::POURCENTAGE_ID;
      }



    }
}
