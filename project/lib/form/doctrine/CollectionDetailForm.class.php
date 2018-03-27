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
                               'piece',
                               'prix'));

        $this->getWidgetSchema()->setLabels(array(
          'devise_id' => 'Devise', 
          'colori' => 'Colori',
          'metrage' => 'Métrage',
          'piece' => 'Pièce',
          'prix' => 'Prix',
        ));
        
        $this->mergePostValidator(new sfValidatorCallback(array('callback' => array($this, 'fctValidatorCallback'))));
    }
    
    public function fctValidatorCallback($validator, $values, $arguments)
    {
    	if ($values['metrage'] && $values['piece'])
    	{
    		throw new sfValidatorErrorSchema($validator, array('piece' => new sfValidatorError($validator, "Métrage ou pièce")));
    	}
    }
}
