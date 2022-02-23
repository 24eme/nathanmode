<?php

/**
 * sfGuardUser filter form.
 *
 * @package    nathanmode
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrinePluginFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardUserFormFilter extends PluginsfGuardUserFormFilter
{
  public function configure()
  {
    $this->setWidget('commercial_id', new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Commercial'), 'add_empty' => true)));
    $this->setValidator('commercial_id', new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Commercial'), 'column' => 'id')));
  	$this->getWidget('first_name')->setOption('with_empty', false);
  	$this->getWidget('last_name')->setOption('with_empty', false);
  	$this->setWidget('created_at', new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%')), 'to_date' => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%')), 'with_empty' => false)));
  	$this->setWidget('last_login', new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%')), 'to_date' => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%')), 'with_empty' => false)));
  }
}
