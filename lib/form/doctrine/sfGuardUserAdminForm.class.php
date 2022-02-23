<?php

/**
 * sfGuardUserAdminForm for admin generators
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardUserAdminForm.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class sfGuardUserAdminForm extends BasesfGuardUserAdminForm
{
  /**
   * @see sfForm
   */
  public function configure()
  {
  	parent::configure();
    $this->setWidget('commercial_id', new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Commercial'), 'add_empty' => true)));
    $this->setValidator('commercial_id', new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Commercial'))));
  }
  public function updateObject($values = null)
  {
	parent::updateObject($values);
	$this->getObject()->setIsSuperAdmin(true);
	$this->getObject()->setIsActive(true);
  }
}
