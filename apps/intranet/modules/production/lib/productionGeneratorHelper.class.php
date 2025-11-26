<?php

/**
 * production module helper.
 *
 * @package    nathanmode
 * @subpackage production
 * @author     Your name here
 * @version    SVN: $Id: helper.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class productionGeneratorHelper extends BaseProductionGeneratorHelper
{
    public function linkToDeleteForm($object, $params)
    {
      if ($object->isNew())
      {
        return '';
      }

      if (sfConfig::get('app_no_metrage')) {
          return link_to(__($params['label'], array(), 'sf_admin'), $this->getUrlForAction('delete'), $object, array('method' => 'delete', 'confirm' => !empty($params['confirm']) ? __($params['confirm'], array(), 'sf_admin') : $params['confirm'], 'class' => ' btn btn-lg bi bi-trash', 'style' => 'width:35px; height:30px; padding-top:4px;color:#164066 !important; background-color:white; border:#164066 solid 1px;'));
      } else {
          return link_to(__($params['label'], array(), 'sf_admin'), $this->getUrlForAction('delete'), $object, array('method' => 'delete', 'confirm' => !empty($params['confirm']) ? __($params['confirm'], array(), 'sf_admin') : $params['confirm'], 'class' => ' btn btn-lg bi bi-trash', 'style' => 'width:35px; height:30px; padding-top:4px;color:#000000 !important; background-color:white; border:#000000 solid 1px;'));
    }

    }

    public function linkToList($params)
    {
        if (sfConfig::get('app_no_metrage')) {
            return link_to(__($params['label'], array(), 'sf_admin'), '@'.$this->getUrlForAction('list'), array('class' => ' btn  btn-lg','style' => 'margin-left:auto; width:95px; height:30px;; color:#164066 !important; background-color:white; border:#164066 solid 1px; margin-left:30rem;'));
        } else {
            return link_to(__($params['label'], array(), 'sf_admin'), '@'.$this->getUrlForAction('list'), array('class' => ' btn  btn-lg','style' => 'margin-left:auto; width:95px; height:30px;; color:#000000 !important; background-color:white; border:#000000 solid 1px; margin-left:30rem;'));
        }
    }

    public function linkToSave($object, $params)
    {
      return '<input type="submit" value="'.__($params['label'], array(), 'sf_admin').'" class="btn btn-lg" style="margin-left:auto; width:95px; height:30px;" />';
    }

}
