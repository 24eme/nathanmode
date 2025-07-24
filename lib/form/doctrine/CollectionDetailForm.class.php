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
                               'prix_achat',
                               'prix',
                               'image'));

        $this->getWidgetSchema()->setLabels(array(
          'devise_id' => 'Devise',
          'colori' => 'Colori',
          'piece' => 'Quantité',
          'prix_achat' => 'Prix d\'achat',
          'prix' => 'Prix',
          'image' => 'Ajouter une image'
        ));

        $this->setWidget('devise_id', new sfWidgetFormInputHidden());
        $this->setValidator('devise_id', new sfValidatorPass(array('required' => false)));
        $this->setWidget('piece_categorie', new sfWidgetFormInputHidden());
        $this->setValidator('piece_categorie', new sfValidatorPass(array('required' => false)));
        $this->setWidget('prix_public', new sfWidgetFormInputHidden());
        $this->setValidator('prix_public', new sfValidatorPass(array('required' => false)));
        $this->setWidget('part_frais', new sfWidgetFormInputHidden());
        $this->setValidator('part_frais', new sfValidatorPass(array('required' => false)));
        $this->setWidget('part_marge', new sfWidgetFormInputHidden());
        $this->setValidator('part_marge', new sfValidatorPass(array('required' => false)));
        $this->setWidget('part_commission', new sfWidgetFormInputHidden());
        $this->setValidator('part_commission', new sfValidatorPass(array('required' => false)));

        $this->setWidget('image', new sfWidgetFormInputFileEditable(array(
            'file_src' => CollectionDetailTable::getInstance()->getUploadPath(false).$this->getObject()->image,
            'is_image' => true,
            'edit_mode' => $this->getObject()->image,
            'with_delete' => true,
            'delete_label' => 'Supprimer la photo',
            'template' => '%input%<br />%delete% %delete_label%'
            )));

        $this->setValidator('image', new sfValidatorFile(array(
            'mime_types' => 'web_images',
            'required' => $this->getValidator('image')->getOption('required'),
            'path' => CollectionDetailTable::getInstance()->getUploadPath(true))
            ));

        $this->setValidator('image_delete', new sfValidatorPass());

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
}
