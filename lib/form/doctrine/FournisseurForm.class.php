<?php

/**
 * Fournisseur form.
 *
 * @package    nathanmode
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FournisseurForm extends BaseFournisseurForm
{
  public function configure()
  {
    $this->getWidget('commission')->setAttribute('class', 'input-float');
    $this->getWidget('devise_id')->setLabel('Unité');
  }

  protected function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();
    $defaults = $this->getDefaults();
    if ($this->isNew()) {
      $defaults['devise_id'] = 3;
    }
    if (sfConfig::get('app_no_metrage')) {
      $defaults['devise_id'] = 4;
      $defaults['commission'] = 100;
    }
    $this->setDefaults($defaults);
  }
}
