<?php

/**
 * CollectionTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class CollectionTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object CollectionTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Collection');
    }

    public function getUploadPath($absolute = false) {

        $path = '/uploads/collection/';

        if ($absolute) {

            return sfConfig::get('sf_web_dir').$path;
        }

        return $path;
    }

    public function queryProductions() {

        return $this->createQuery('c')
                    ->addWhere('c.production = ?', true);
    }

    public function queryCollections() {

        return $this->createQuery('c')
                   ->addWhere('c.production = ?', false);
    }

    public function getAll() {
        return $this->createQuery('c')->execute();
    }

    public function getNonLivres($isProduction, $nbJour, $nbRelance) {
      return $this->createQuery('c')
                  ->addWhere('(c.situation = \''.Situations::SITUATION_ATT_CONFIRMATION.'\' OR c.situation = \''.Situations::SITUATION_EN_COURS.'\' )')
                  ->addWhere('c.date_livraison <= ?', date('Y-m-d', strtotime("+$nbJour day")))
                  ->addWhere('c.nb_relance = ?', $nbRelance)
                  ->addWhere('c.production = ?', $isProduction)
                  ->execute();
    }

    public function getBySaisonQualiteNotClient($saisonId, $qualite, $clientId) {
      return $this->createQuery('c')
                  ->addWhere('c.saison_id = ?', $saisonId)
                  ->addWhere('c.qualite = ?', $qualite)
                  ->addWhere('c.client_id != ?', $clientId)
                  ->execute();
    }

    public function getQualites() {
      return Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc('select distinct qualite from collection');
    }
}
