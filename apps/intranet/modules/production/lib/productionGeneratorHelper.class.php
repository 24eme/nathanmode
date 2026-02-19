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

        return link_to(__($params['label'], array(), 'sf_admin'), $this->getUrlForAction('delete'), $object, array('method' => 'delete', 'confirm' => !empty($params['confirm']) ? __($params['confirm'], array(), 'sf_admin') : $params['confirm'], 'class' => ' btn btn-lg bi bi-trash', 'style' => 'width:35px; height:2.25rem; padding-top:6px;color: var(--couleur-primaire) !important; background-color:white; border: var(--couleur-primaire) solid 1px; line-height:2rem;'));


    }

    public function linkToList($params)
    {
      if (isset($params['params']) && isset($params['params']['obj'])) {
        $obj = $params['params']['obj'];
        if ($obj->isSoldee()) {
          return link_to(__($params['label'], array(), 'sf_admin'), 'productiondetails/CommandesSoldees', array('class' => ' btn  btn-lg','style' => 'margin-left:auto; width:95px; height:2.25rem; color: var(--couleur-primaire) !important; background-color:white; border: var(--couleur-primaire) solid 1px; margin-left:30rem;line-height:1.5rem !important;font-size:1rem !important;'));
        }
      }
      return link_to(__($params['label'], array(), 'sf_admin'), '@collection_detail', array('class' => ' btn  btn-lg','style' => 'margin-left:auto; width:95px; height:2.25rem; color: var(--couleur-primaire) !important; background-color:white; border: var(--couleur-primaire) solid 1px; margin-left:30rem; font-size:1rem !important; padding:0.25rem 1rem;line-height:1.5rem !important;'));
    }

    public function linkToSave($object, $params)
    {
      return '<input type="submit" value="'.__($params['label'], array(), 'sf_admin').'" class="btn btn-lg" style="margin-left:auto; width:95px; height:30px; padding:0 !important;" />';
    }

}
