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
                               'metrage',
                               'piece_categorie',
                               'piece',
                               'prix'));

        $this->getWidgetSchema()->setLabels(array(
          'devise_id' => 'Devise',
          'colori' => 'Colori',
          'metrage' => 'Métrage',
          'piece' => 'PF Type',
          'piece' => 'PF',
          'prix' => 'Prix',
        ));

        $this->setWidget('piece_categorie', new sfWidgetFormChoice(array('choices' => $this->getPieceCategories())));
        $this->setValidator('piece_categorie', new sfValidatorChoice(
            array('choices' => array_keys($this->getPieceCategories()),
                  'required' => $this->getValidator('piece_categorie')->getOption('required'),
                )
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
}
