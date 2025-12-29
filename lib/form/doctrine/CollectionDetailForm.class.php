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
        $collection = $this->getObject()->getCollection();

        $this->useFields(array('devise_id',
                               'colori',
                               'piece_categorie',
                               'piece',
                               'prix_achat',
                               'prix',
                               'prix_public',
			       'part_frais',
                               'image',
                               'date_livraison_prevue',
                               'date_livraison_demandee',
			       'reste_a_livrer_produit',
			       'piece_categorie',
			       'qualite',
             'commande_soldee',
			      ));

        $this->getWidgetSchema()->setLabels(array(
          'devise_id' => 'Devise',
          'colori' => 'Colori',
          'piece' => 'Quantité',
          'prix_achat' => 'Prix d\'achat',
          'prix' => 'Prix',
	  'prix_public' => 'Prix public TTC',
	  'part_frais' => 'Frais d\'approche',
	  'image' => 'Ajouter une image',
	  'date_livraison_prevue' => 'Date de livraison prévue',
	  'date_livraison_demandee' => 'Date de livraison demandée',
	  'reste_a_livrer_produit' => 'Reste à livrer produit',
          'piece_categorie' => 'Catégorie',
	  'qualite' => 'Référence'
        ));

        $this->setWidget('devise_id', new sfWidgetFormInputHidden());
        $this->setValidator('devise_id', new sfValidatorPass(array('required' => false)));
        $this->setWidget('date_livraison_prevue', new WidgetFormInputDate());
        $this->setValidator('date_livraison_prevue', new sfValidatorDate(array('required' => false)));
        $this->setWidget('date_livraison_demandee', new WidgetFormInputDate());
        $this->setValidator('date_livraison_demandee', new sfValidatorDate(array('required' => false)));

        $this->setWidget('prix_public', new sfWidgetFormInputText());
        $this->setValidator('prix_public', new sfValidatorPass(array('required' => false)));
	$this->setWidget('part_frais', new sfWidgetFormInputText());
	$this->setValidator('part_frais', new sfValidatorPass(array('required' => false)));

       if (sfConfig::get('app_no_metrage')) {
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

	 $this->setWidget('piece_categorie', new sfWidgetFormChoice(array('choices' => $this->getPieceCategoriesGrouped())));
        $this->setValidator('piece_categorie', new sfValidatorChoice(array('choices' => array_keys($this->getPieceCategories()),'required' => $this->getValidator('piece_categorie')->getOption('required'),
)));

      if(!sfConfig::get('app_no_metrage')) {
          unset($this['part_frais'], $this['prix_public'], $this['prix_achat']);
      }

      $this->setWidget('qualite', new sfWidgetFormInput());
      $this->setValidator('qualite', new sfValidatorString());
    }


    public function processValues($values) {
	if($values['image'] instanceof sfValidatedFile) {
		$imageOrig =  $values['image'];
		$imageTempName = $imageOrig->getTempName();
		$imageTempFile = $imageOrig->generateFilename();
		$imageType = $imageOrig->getType();
		$width = 1000;
		$height = 1000;

		$path =  ltrim(CollectionDetailTable::getInstance()->getUploadPath(), '/');

		list($width_orig, $height_orig) = getimagesize($imageTempName);
		$ratio_orig = $width_orig/$height_orig;

		if ($width/$height > $ratio_orig) {
			$width = $height*$ratio_orig;
		} else {
			$height = $width/$ratio_orig;
		}

		if ($imageType === 'image/jpeg' || $imageType === 'image/pjpeg') {
			$imageRessource = imagecreatefromjpeg($imageTempName);
		}elseif($imageType === 'image/png' || $imageType === 'image/x-png') {
			$imageRessource = imagecreatefrompng($imageTempName);
		} elseif($imageType === 'image/gif') {
			$imageRessource = imagecreatefromgif($imageTempName);
		} elseif($imageType === 'image/webp') {
			$imageRessource = imagecreatefromwebp($imageTempName);
		}

		$imageNew = imagecreatetruecolor($width, $height);

		if($imageType === 'image/png' || $imageType === 'image/x-png' || $imageType === 'image/gif' || $imageType === 'image/webp') {
			$transparencyIndex = imagecolortransparent($imageRessource);
			$transparencyColor = array('red' => 255, 'green' => 255, 'blue' => 255);
			if ($transparencyIndex >= 0) {
				$transparencyColor = imagecolorsforindex($imageOrig, $transparencyIndex);
			}
			$transparencyIndex = imagecolorallocatealpha($imageNew, $transparencyColor['red'], $transparencyColor['green'], $transparencyColor['blue'], 127);
			imagefill($imageNew, 0, 0, $transparencyIndex);
			imagesavealpha($imageNew, true);
			imagecolortransparent($imageNew, $transparencyIndex);
		}

		imagecopyresampled($imageNew,$imageRessource , 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
		if ($imageType === 'image/jpeg' || $imageType === 'image/pjpeg') {
			imagejpeg($imageNew, '/tmp/'.$imageTempFile);
		} elseif($imageType === 'image/png' || $imageType === 'image/x-png') {
			imagepng($imageNew, '/tmp/'.$imageTempFile);
		} elseif($imageType === 'image/gif') {
			imagegif($imageNew, '/tmp/'.$imageTempFile);
		} elseif($imageType === 'image/webp') {
			imagewebp($imageNew, '/tmp/'.$imageTempFile);
		}

		$finalImage = new sfValidatedFile($imageTempFile, $imageType, '/tmp/'.$imageTempFile, filesize('/tmp/'.$imageTempFile), $path);

		if ($this->getObject()->image) {
			unlink('uploads/production_images/'.$this->getObject()->image);
		}
		$this->getObject()->setImage($finalImage->save($imageTempFile));
		$values['image'] = $finalImage;

		imagedestroy($imageNew);
		imagedestroy($imageRessource);
	}
	return parent::processValues($values);
    }

    public function updateDefaultsFromObject() {
      parent::updateDefaultsFromObject();

      if ($this->getObject()->metrage) {
        $this->defaults['piece'] = $this->getObject()->metrage;
      }

      if ($this->getObject()->part_frais == null ) {
	      $this->defaults['part_frais'] = 30;
      }

      if(!sfConfig::get('app_no_metrage') && !$this->getObject()->piece_categorie) {
          $this->defaults['piece_categorie'] = "METRAGE";
      }


    }

    public function doUpdateObject($values) {
      if($values['piece_categorie'] == "METRAGE" && !sfConfig::get('app_no_metrage')) {
          $values['metrage'] = $values['piece'];
          $values['piece_categorie'] = null;
          $values['piece'] = null;
      } else {
        $values['metrage'] = null;
      }

      if ('/tmp/'.$this->getObject()->image){
        unlink('/tmp/'.$this->getObject()->image);
      }


      parent::doUpdateObject($values);
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
