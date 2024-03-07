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

        $this->setWidget('prix', new sfWidgetFormInput());
        $this->setValidator('prix', new sfValidatorPass());

        $this->setWidget('quantite', new sfWidgetFormInput());
        $this->setValidator('quantite', new sfValidatorPass());

        $this->setWidget('livre_le', new sfWidgetFormInput(array('type' => 'date')));
        $this->setValidator('livre_le', new sfValidatorPass());

        $this->setWidget('num_facture', new sfWidgetFormInput(array(), array('autocomplete' => 'off')));
        $this->setValidator('num_facture', new sfValidatorPass());

        $this->setWidget('fichier', new sfWidgetFormInputFile(array()));
        $this->setValidator('fichier', new sfValidatorFile(array('required' => false, 'path' => FactureTable::getInstance()->getUploadPath(true))));

        $this->setWidget('fichier_confirmation', new sfWidgetFormInputFile(array()));
        $this->setValidator('fichier_confirmation', new sfValidatorFile(array('required' => false, 'path' => CoupeTable::getInstance()->getUploadPath(true))));

        $this->widgetSchema->setNameFormat('coupe_ligne[%s]');
    }

    public function save() {
        $values = $this->getValues();

        if(isset($values['num_facture']) && $values['num_facture']) {
            $this->coupe->setNumFacture($values['num_facture']);
        }

        if(isset($values['quantite']) && $values['quantite']) {
            if($this->coupe->getPiece()) {
                $this->coupe->setPiece($values['quantite']);
            } else {
                $this->coupe->setMetrage($values['quantite']);
            }
        }

        if(isset($values['prix']) && $values['prix']) {
            $this->coupe->setPrix($values['prix']);
        }

        if(isset($values['livre_le']) && $values['livre_le']) {
            $this->coupe->setLivreLe($values['livre_le']);
        }

        if(isset($values['fichier'])) {
            $this->coupe->setFichier($values['fichier']->generateFilename());
            $values['fichier']->save($this->coupe->getFichier());
        }

        if(isset($values['fichier_confirmation'])) {
            $this->coupe->setFichierConfirmation($values['fichier_confirmation']->generateFilename());
            $values['fichier_confirmation']->save($this->coupe->getFichierConfirmation());
        }

        $this->coupe->save();
    }
}
