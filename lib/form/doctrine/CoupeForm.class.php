<?php

/**
 * Coupe form.
 *
 * @package    nathanmode
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CoupeForm extends BaseCoupeForm
{
  public function configure()
  {
  	unset($this['facture_id'], $this['commande_id'], $this['date_livraison'], $this['date_commande'], $this['retard_livraison']);
  	$this->setWidget('paiement', new sfWidgetFormChoice(array('choices' => $this->getPaiements())));
        $this->setValidator('paiement', new sfValidatorChoice(
            array('choices' => array_keys($this->getPaiements()),
                  'required' => $this->getValidator('paiement')->getOption('required'),
                )
            ));
  		$this->setWidget('fichier', new sfWidgetFormInputFileEditable(array(
                                                                      'file_src' => FactureTable::getInstance()->getUploadPath(false).$this->getObject()->fichier,
                                                                       'edit_mode' => $this->getObject()->fichier,
                                                                       'template' => '<a href="%file%" target="_blank">Télécharger le fichier</a><br />%input%<br />%delete% %delete_label%'
                                                                    )));
  		$this->setWidget('livre_le', new sfWidgetFormInputText());
  		$this->getWidget('livre_le')->setLabel("Expédié le");
  		
      $this->setValidator('fichier', new sfValidatorFile(array('required' => false, 
                                                               'path' => FactureTable::getInstance()->getUploadPath(true))));

      $this->setValidator('livre_le', new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~', 'required' => false)));

      $this->setValidator('fichier_delete', new sfValidatorPass());


      $this->getWidget('piece')->setLabel("Produit Fini");
      $this->setWidget('piece_categorie', new sfWidgetFormChoice(array('choices' => $this->getPieceCategories())));
      $this->getWidget('piece_categorie')->setLabel("PF Type");
      $this->setValidator('piece_categorie', new sfValidatorChoice(
          array('choices' => array_keys($this->getPieceCategories()),
                'required' => $this->getValidator('piece_categorie')->getOption('required'),
              )
          ));

      $this->mergePostValidator(new sfValidatorCallback(array('callback' => array($this, 'fctValidatorCallback'))));
  }
    
    public function fctValidatorCallback($validator, $values, $arguments)
    {
    	if ($values['metrage'] && $values['piece'])
    	{
    		throw new sfValidatorErrorSchema($validator, array('piece' => new sfValidatorError($validator, "Métrage ou pièce")));
    	}
    	return $values;
    }

    public function getPieceCategories() {

        return array_merge(array("" => ""), PieceCategories::getListe());
    }

    public function getPaiements() {

        return ConditionsPaiement::getListe();
    }
  public function updateDefaultsFromObject() {
      parent::updateDefaultsFromObject();

      if ($this->getObject()->livre_le) {
        $this->defaults['livre_le'] = $this->getObject()->getDateTimeObject('livre_le')->format('d/m/Y');
      }

      if (!$this->getObject()->commercial_devise_id) {
        $this->defaults['commercial_devise_id'] = Devise::POURCENTAGE_ID;
      }

      if (!$this->getObject()->fournisseur_devise_id) {
        $this->defaults['fournisseur_devise_id'] = Devise::POURCENTAGE_ID;
      }
    }
}
