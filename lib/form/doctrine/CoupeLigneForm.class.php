<?php

/**
 * Coupe form.
 *
 * @package    nathanmode
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CoupeLigneForm extends BaseForm
{
    protected $coupe;
    
    public function __construct(Coupe $coupe, $options = array(), $CSRFSecret = null)
    {
        $this->coupe = $coupe;
        parent::__construct(array(), $options, $CSRFSecret);
    }
    
    public function configure()
    {
        $this->disableLocalCSRFProtection();
        
        $this->setWidget('situation', new sfWidgetFormChoice(array('choices' => array_merge(array("" => "Select an option"), CoupeForm::getSituations()))));
        $this->setValidator('situation', new sfValidatorChoice(array('choices' => array_keys(CoupeForm::getSituations()), 'required' => false)));
        
        $this->setWidget('livre_le', new sfWidgetFormInput(array('type' => 'date')));
        $this->setValidator('livre_le', new sfValidatorPass());
        
        $this->setWidget('num_facture', new sfWidgetFormInput(array(), array('autocomplete' => 'off')));
        $this->setValidator('num_facture', new sfValidatorPass());
        
        $this->setWidget('fichier', new sfWidgetFormInputFile(array()));
        $this->setValidator('fichier', new sfValidatorFile(array('required' => false, 'path' => FactureTable::getInstance()->getUploadPath(true))));
        
        $this->widgetSchema->setNameFormat('coupe_ligne[%s]');
    }
    
    public function save() {
        $values = $this->getValues();
        
        if(isset($values['situation'])) {
            $this->coupe->setSituation($values['situation']);
        }
        
        if(isset($values['num_facture']) && $values['num_facture']) {
            $this->coupe->setNumFacture($values['num_facture']);
        }
        
        if(isset($values['livre_le']) && $values['livre_le']) {
            $this->coupe->setLivreLe($values['livre_le']);
        }
        
        if(isset($values['fichier'])) {
            $this->coupe->setFichier($values['fichier']->generateFilename());
            $values['fichier']->save($this->coupe->getFichier());
        }
        
        $this->coupe->save();
    }
}   
