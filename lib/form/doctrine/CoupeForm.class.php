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
  	unset($this['facture_id'], $this['commande_id'], $this['date_livraison'], $this['retard_livraison']);
  	$this->setWidget('paiement', new sfWidgetFormChoice(array('choices' => $this->getPaiements())));
        $this->setValidator('paiement', new sfValidatorChoice(
            array('choices' => array_keys($this->getPaiements()),
                  'required' => $this->getValidator('paiement')->getOption('required'),
                )
            ));
  		$this->setWidget('fichier', new sfWidgetFormInputFileEditable(array(
                                                                      'file_src' => FactureTable::getInstance()->getUploadPath(false).$this->getObject()->fichier,
                                                                       'edit_mode' => $this->getObject()->fichier,
                                                                       'template' => '%input%<br />%delete% Suppr. le fichier<a href="%file%" target="_blank">Voir le fichier</a>'
                                                                    )));
  		$this->setWidget('livre_le', new sfWidgetFormInputText(array(), array('type' => 'date')));
  		$this->getWidget('livre_le')->setLabel("Expédié le");
        $this->setValidator('livre_le', new sfValidatorDate(array('date_format' => '~(?P<year>\d{4})-(?P<month>\d{2})-(?P<day>\d{2})~', 'required' => false)));

        $this->getWidget('num_facture')->setLabel("Facture n°");
        $this->getWidget('tissu')->setLabel("Qualité");

        $this->setWidget('num_commande', new sfWidgetFormInput(array(), array('autocomplete' => 'off')));
        $this->getWidget('num_commande')->setLabel("Commande n°");
        $this->setValidator('num_commande', new sfValidatorPass());

        $this->setWidget('num_confirmation', new sfWidgetFormInput(array(), array('autocomplete' => 'off')));
        $this->getWidget('num_confirmation')->setLabel("Confirmation n°");
        $this->setValidator('num_confirmation', new sfValidatorPass());

        $this->setWidget('date_commande', new sfWidgetFormInputText(array(), array('type' => 'date')));
  		$this->getWidget('date_commande')->setLabel("Date commande");
        $this->setValidator('date_commande', new sfValidatorDate(array('date_format' => '~(?P<year>\d{4})-(?P<month>\d{2})-(?P<day>\d{2})~', 'required' => false)));

      $this->setValidator('fichier', new sfValidatorFile(array('required' => false,
                                                               'path' => FactureTable::getInstance()->getUploadPath(true))));


      $this->setValidator('fichier_delete', new sfValidatorPass());

      $this->setWidget('fichier_confirmation', new sfWidgetFormInputFileEditable(array(
                                                                    'file_src' => CoupeTable::getInstance()->getUploadPath(false).$this->getObject()->fichier_confirmation,
                                                                     'edit_mode' => $this->getObject()->fichier_confirmation,
                                                                     'template' => '%input%<br />%delete% Suppr. le fichier<a href="%file%" target="_blank">Voir le fichier</a>'
                                                                  )));
      $this->setValidator('fichier_confirmation', new sfValidatorFile(
          array('required' => false,
                'path' => CoupeTable::getInstance()->getUploadPath(true))
          ));
      $this->setValidator('fichier_confirmation_delete', new sfValidatorPass());

      $this->setValidator('prix', new sfValidatorNumber(array('required' => false)));
      $this->setValidator('commission_fournisseur', new sfValidatorNumber(array('required' => false)));
      $this->setValidator('commission_commercial', new sfValidatorNumber(array('required' => false)));
      $this->setValidator('montant_facture', new sfValidatorNumber(array('required' => false)));

      $this->getWidget('piece')->setLabel("Produit Fini");
      $this->setWidget('piece_categorie', new sfWidgetFormChoice(array('choices' => $this->getPieceCategories())));
      $this->getWidget('piece_categorie')->setLabel("PF Catégorie");
      $this->setValidator('piece_categorie', new sfValidatorChoice(
          array('choices' => array_keys($this->getPieceCategories()),
                'required' => $this->getValidator('piece_categorie')->getOption('required'),
              )
          ));

      $this->setWidget('situation', new sfWidgetFormChoice(array('choices' => array_merge(array("" => " "), CoupeForm::getSituations()))));
      $this->setValidator('situation', new sfValidatorChoice(array('choices' => array_keys(CoupeForm::getSituations()), 'required' => false)));

      $this->getWidget('prix')->setAttribute('class', 'input-float');
      $this->getWidget('commission_fournisseur')->setAttribute('class', 'input-float');
      $this->getWidget('commission_commercial')->setAttribute('class', 'input-float');
      $this->getWidget('montant_facture')->setAttribute('class', 'input-float');

      $this->setWidget('saison_id', new sfWidgetFormChoice(array('choices' => $this->getSaisons())));

      $this->mergePostValidator(new sfValidatorCallback(array('callback' => array($this, 'fctValidatorCallback'))));
    }

    public function getSaisons() {
        return SaisonTable::getInstance()->getListeTriee();
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
      
      if (!$this->getObject()->commercial_devise_id) {
        $this->defaults['commercial_devise_id'] = Devise::POURCENTAGE_ID;
      }

      if (!$this->getObject()->fournisseur_devise_id) {
        $this->defaults['fournisseur_devise_id'] = Devise::POURCENTAGE_ID;
      }
    }
    
    public static function getSituations() {

        return array_filter(Situations::getListe(), function($k) { return in_array($k, array('ATT_CONFIRMATION', 'EN_COURS', 'ATTENTE_LIVRAISON',  'EXPE_ATT_FACTURE', 'ATTENTE_PAIEMENT', 'SOLDEE')); }, ARRAY_FILTER_USE_KEY);
    }
    
    
    public static function getQuantiteType() {

        return array_merge(array("METRAGE" => "Métrage"), PieceCategories::getListe());
    }
}
