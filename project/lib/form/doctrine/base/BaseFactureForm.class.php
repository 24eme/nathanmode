<?php

/**
 * Facture form base class.
 *
 * @method Facture getObject() Returns the current form's model object
 *
 * @package    nathanmode
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFactureForm extends BonForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('facture[%s]');
  }

  public function getModelName()
  {
    return 'Facture';
  }

}
