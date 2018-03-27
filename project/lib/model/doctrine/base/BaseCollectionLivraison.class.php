<?php

/**
 * BaseCollectionLivraison
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $collection_id
 * @property integer $devise_id
 * @property integer $escompte_devise_id
 * @property integer $facture_id
 * @property string $colori
 * @property string $metrage
 * @property double $prix
 * @property double $escompte
 * @property string $adresse_livraison
 * @property date $date
 * @property string $num_facture
 * @property string $fichier
 * @property string $packing_list
 * @property Collection $Collection
 * @property Devise $Devise
 * @property Devise $EscompteDevise
 * @property Facture $Facture
 * 
 * @method integer             getCollectionId()       Returns the current record's "collection_id" value
 * @method integer             getDeviseId()           Returns the current record's "devise_id" value
 * @method integer             getEscompteDeviseId()   Returns the current record's "escompte_devise_id" value
 * @method integer             getFactureId()          Returns the current record's "facture_id" value
 * @method string              getColori()             Returns the current record's "colori" value
 * @method string              getMetrage()            Returns the current record's "metrage" value
 * @method double              getPrix()               Returns the current record's "prix" value
 * @method double              getEscompte()           Returns the current record's "escompte" value
 * @method string              getAdresseLivraison()   Returns the current record's "adresse_livraison" value
 * @method date                getDate()               Returns the current record's "date" value
 * @method string              getNumFacture()         Returns the current record's "num_facture" value
 * @method string              getFichier()            Returns the current record's "fichier" value
 * @method string              getPackingList()        Returns the current record's "packing_list" value
 * @method Collection          getCollection()         Returns the current record's "Collection" value
 * @method Devise              getDevise()             Returns the current record's "Devise" value
 * @method Devise              getEscompteDevise()     Returns the current record's "EscompteDevise" value
 * @method Facture             getFacture()            Returns the current record's "Facture" value
 * @method CollectionLivraison setCollectionId()       Sets the current record's "collection_id" value
 * @method CollectionLivraison setDeviseId()           Sets the current record's "devise_id" value
 * @method CollectionLivraison setEscompteDeviseId()   Sets the current record's "escompte_devise_id" value
 * @method CollectionLivraison setFactureId()          Sets the current record's "facture_id" value
 * @method CollectionLivraison setColori()             Sets the current record's "colori" value
 * @method CollectionLivraison setMetrage()            Sets the current record's "metrage" value
 * @method CollectionLivraison setPrix()               Sets the current record's "prix" value
 * @method CollectionLivraison setEscompte()           Sets the current record's "escompte" value
 * @method CollectionLivraison setAdresseLivraison()   Sets the current record's "adresse_livraison" value
 * @method CollectionLivraison setDate()               Sets the current record's "date" value
 * @method CollectionLivraison setNumFacture()         Sets the current record's "num_facture" value
 * @method CollectionLivraison setFichier()            Sets the current record's "fichier" value
 * @method CollectionLivraison setPackingList()        Sets the current record's "packing_list" value
 * @method CollectionLivraison setCollection()         Sets the current record's "Collection" value
 * @method CollectionLivraison setDevise()             Sets the current record's "Devise" value
 * @method CollectionLivraison setEscompteDevise()     Sets the current record's "EscompteDevise" value
 * @method CollectionLivraison setFacture()            Sets the current record's "Facture" value
 * 
 * @package    nathanmode
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCollectionLivraison extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('collection_livraison');
        $this->hasColumn('collection_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('devise_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('escompte_devise_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('facture_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('colori', 'string', 128, array(
             'type' => 'string',
             'length' => 128,
             ));
        $this->hasColumn('metrage', 'string', 128, array(
             'type' => 'string',
             'length' => 128,
             ));
        $this->hasColumn('prix', 'double', null, array(
             'type' => 'double',
             ));
        $this->hasColumn('escompte', 'double', null, array(
             'type' => 'double',
             ));
        $this->hasColumn('adresse_livraison', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('date', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('num_facture', 'string', 128, array(
             'type' => 'string',
             'length' => 128,
             ));
        $this->hasColumn('fichier', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('packing_list', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Collection', array(
             'local' => 'collection_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Devise', array(
             'local' => 'devise_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Devise as EscompteDevise', array(
             'local' => 'escompte_devise_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Facture', array(
             'local' => 'facture_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));
    }
}