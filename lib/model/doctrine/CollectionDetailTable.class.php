<?php

/**
 * CollectionDetailTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class CollectionDetailTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object CollectionDetailTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('CollectionDetail');
    }

    public function getAll() {
        return $this->createQuery('d')->execute();
    }

    public function queryProductionExcluded() {

        return $this->createQuery('d')
                    ->leftJoin('d.Collection c')
                    ->leftJoin('d.Devise de')
                    ->leftJoin('c.Fournisseur f')
                	  ->leftJoin('c.Saison s')
                	  ->leftJoin('c.Client cl')
                    ->whereNotIn('c.situation', array(Situations::SITUATION_SOLDEE, Situations::SITUATION_ECRU_DESIGNER))
                    ->addWhere('c.production = ?', false);
    }

    public function queryProductions() {

        return $this->createQuery('d')
                    ->leftJoin('d.Devise de')
                    ->leftJoin('d.Collection c')
                    ->leftJoin('c.Saison s')
                    ->leftJoin('c.Fournisseur f')
                    ->leftJoin('c.Client cl')
                    ->addWhere('c.production = ?', true);
    }

    public function getUploadPath($absolute = false) {

        $path = '/uploads/production_images/';

        if ($absolute) {

            return sfConfig::get('sf_web_dir').$path;
        }

        return $path;
    }
}
