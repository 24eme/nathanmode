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
                               'image',
                               'date_livraison_prevue',
			       'reste_a_livrer_produit',
			       'qualite'));

        $this->getWidgetSchema()->setLabels(array(
          'devise_id' => 'Devise',
          'colori' => 'Colori',
          'piece' => 'Quantité',
          'prix_achat' => 'Prix d\'achat',
          'prix' => 'Prix',
          'image' => 'Ajouter une image',
          'date_livraison_prevue' => 'Date de livraison prévue',
	  'reste_a_livrer_produit' => 'Reste à livrer produit',
	  'qualite' => 'Référence'
        ));

        $this->setWidget('devise_id', new sfWidgetFormInputHidden());
        $this->setValidator('devise_id', new sfValidatorPass(array('required' => false)));
        $this->setWidget('piece_categorie', new sfWidgetFormInputHidden());
        $this->setValidator('piece_categorie', new sfValidatorPass(array('required' => false)));
        $this->setWidget('prix_public', new sfWidgetFormInputHidden());
        $this->setValidator('prix_public', new sfValidatorPass(array('required' => false)));
        $this->setWidget('part_frais', new sfWidgetFormInputHidden());
        $this->setValidator('part_frais', new sfValidatorPass(array('required' => false)));
        $this->setWidget('part_commission', new sfWidgetFormInputHidden());
        $this->setValidator('part_commission', new sfValidatorPass(array('required' => false)));
        $this->setWidget('date_livraison_prevue', new WidgetFormInputDate());
        $this->setValidator('date_livraison_prevue', new sfValidatorDate(array('required' => false)));

        if (sfConfig::get('app_devise_dollar')) {
            $this->setWidget('image', new sfWidgetFormInputFileEditable(array(
                'file_src' => CollectionDetailTable::getInstance()->getUploadPath(false).$this->getObject()->image,
                'is_image' => true,
                'edit_mode' => $this->getObject()->image,
                'with_delete' => false,
                'template' => '%input%<br />'
                )));

            $this->setValidator('image', new sfValidatorFile(array(
                'mime_types' => array('image/jpeg', 'image/pjpeg', 'image/png', 'image/x-png', 'image/gif','image/webp'),
                'required' => $this->getValidator('image')->getOption('required'),
                'path' => CollectionDetailTable::getInstance()->getUploadPath(true))
                ));

            $this->setValidator('image_delete', new sfValidatorPass());
        }

    $this->getWidget('reste_a_livrer_produit')->setAttribute('class', 'input-float');
    $this->setValidator('reste_a_livrer_produit', new sfValidatorNumber(array('required' => false)));

        if($this->getObject()->reste_a_livrer_produit === null) {
            $collection = $this->getObject()->getCollection();
            $this->getObject()->updateResteALivrerProduit($collection);
	}
    $this->setWidget('qualite', new sfWidgetFormInput());
    $this->setValidator('qualite', new sfValidatorString(array('required' => true)));

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
