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
          					   'prix',
          					   'escompte',
          					   'escompte_devise_id',
                               'adresse_livraison',
                               'date', 
                               'num_facture', 
                               'fichier', 
                               'packing_list'));

        $this->setWidget('date', new sfWidgetFormInputText());
        $this->setValidator('date', new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~', 'required' => false)));
        

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

        $this->getWidgetSchema()->setLabels(array(
          'colori' => 'Colori',  
          'devise_id' => 'Devise;',
          'escompte_devise_id' => 'Escompte devise;',
          'metrage' => 'Métrage',
          'prix' => 'Prix',
          'escompte' => 'Escompte',
          'adresse_livraison' => 'Adresse de livraison',
          'date' => 'Date', 
          'num_facture' => 'Facture n°', 
          'fichier' => 'Joindre', 
          'packing_list' => 'Packing list',
        ));
        $this->widgetSchema->setHelp('date', '(jj/mm/aaaa)');
    }

    public function updateDefaultsFromObject() {
      parent::updateDefaultsFromObject();

      if ($this->getObject()->date) {
        $this->defaults['date'] = $this->getObject()->getDateTimeObject('date')->format('d/m/Y');
      }
      
      if (!$this->getObject()->escompte_devise_id) {
        $this->defaults['escompte_devise_id'] = Devise::POURCENTAGE_ID;
      }
      
        
        
    }
}
