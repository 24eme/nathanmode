<?php

/**
 * CollectionDetail form.
 *
 * @package    nathanmode
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CollectionDetailForm extends BaseCollectionDetailForm
{
    public function configure()
    {
        $this->useFields(array('devise_id',
                               'colori',
                               'piece_categorie',
                               'piece',
                               'prix',
                               'image'));

        $this->getWidgetSchema()->setLabels(array(
          'devise_id' => 'Devise',
          'colori' => 'Colori',
          'piece' => 'Quantité Type',
          'piece' => 'Quantité',
          'prix' => 'Prix',
          'image' => 'Ajouter une image'
        ));

        $this->setWidget('piece_categorie', new sfWidgetFormChoice(array('choices' => $this->getPieceCategories())));
        $this->setValidator('piece_categorie', new sfValidatorChoice(
            array('choices' => array_keys($this->getPieceCategories()),
                  'required' => $this->getValidator('piece_categorie')->getOption('required'),
                )
            ));

        $this->setWidget('image', new sfWidgetFormInputFileEditable(array(
            'file_src' => CollectionDetailTable::getInstance()->getUploadPath(false).$this->getObject()->image,
            'edit_mode' => $this->getObject()->image,
            'template' => '%input%<br />%delete% Suppr. le fichier<a href="%file%" target="_blank">Voir le fichier</a>'
                                                                    )));
        $this->setValidator('image', new sfValidatorFile(
            array('required' => $this->getValidator('image')->getOption('required'),
                    'path' => CollectionDetailTable::getInstance()->getUploadPath(true))
            ));
    }

    public function updateDefaultsFromObject() {
      parent::updateDefaultsFromObject();

      if ($this->getObject()->metrage) {
        $this->defaults['piece'] = $this->getObject()->metrage;
      }
    }

    public function doUpdateObject($values) {
      if($values['piece_categorie'] == "METRAGE") {
          $values['metrage'] = $values['piece'];
          $values['piece_categorie'] = null;
          $values['piece'] = null;
      } else {
        $values['metrage'] = null;
      }
      parent::doUpdateObject($values);
    }

    public function getPieceCategories() {

        return array_merge(array("METRAGE" => "Métrage"), PieceCategories::getListe());
    }
}
