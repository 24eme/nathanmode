<?php

/**
 * collection module helper.
 *
 * @package    nathanmode
 * @subpackage collection
 * @author     Your name here
 * @version    SVN: $Id: helper.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class collectionGeneratorHelper extends BaseCollectionGeneratorHelper
{
    public function linkToSaveAndProduction($object, $params)
    {
        return '<input type="submit" value="'.__($params['label'], array(), 'sf_admin').'" name="save_and_production" style="display:none" />';
    }
}
