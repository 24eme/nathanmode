[?php

/**
 * <?php echo $this->getModuleName() ?> module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage <?php echo $this->getModuleName()."\n" ?>
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: helper.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class Base<?php echo ucfirst($this->getModuleName()) ?>GeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? '<?php echo $this->params['route_prefix'] ?>' : '<?php echo $this->params['route_prefix'] ?>_'.$action;
  }

  public function linkToNew($params)
  {
    return link_to(__($params['label'], array(), 'sf_admin'), '@'.$this->getUrlForAction('new'));
  }

  public function linkToEdit($object, $params)
  {
    return link_to('<img width="16" height="16" alt="Editer" title="Editer" src="/images/modifier.png" />', $this->getUrlForAction('edit'), $object);
  }
 	
  public function linkToDelete($object, $params)
  {
    if ($object->isNew())
    {
      return '';
    }
    return link_to('<img width="16" height="16" alt="Supprimer" title="Supprimer" src="/images/delete.png" />', $this->getUrlForAction('delete'), $object, array('method' => 'delete', 'confirm' => !empty($params['confirm']) ? __($params['confirm'], array(), 'sf_admin') : $params['confirm']));
  }
  
  public function linkToSaveAndAdd($object, $params)
  {
    if (!$object->isNew())
    {
      return '';
    }
	
    return '<input type="submit" value="'.__($params['label'], array(), 'sf_admin').'" name="_save_and_add" />';
  }
  
  public function linkToDeleteForm($object, $params)
  {
    if ($object->isNew())
    {
      return '';
    }	
    return link_to(__($params['label'], array(), 'sf_admin'), $this->getUrlForAction('delete'), $object, array('method' => 'delete', 'confirm' => !empty($params['confirm']) ? __($params['confirm'], array(), 'sf_admin') : $params['confirm']));
  }

  public function linkToList($params)
  {
    return link_to(__($params['label'], array(), 'sf_admin'), '@'.$this->getUrlForAction('list'));
  }

  public function linkToSave($object, $params)
  {
    return '<input type="submit" value="'.__($params['label'], array(), 'sf_admin').'" />';
  }
}
