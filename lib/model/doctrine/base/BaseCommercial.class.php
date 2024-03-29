<?php

/**
 * BaseCommercial
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $devise_id
 * @property string $nom
 * @property string $prenom
 * @property string $email
 * @property string $telephone
 * @property double $commission
 * @property Devise $Devise
 * @property Doctrine_Collection $Coupes
 * @property Doctrine_Collection $Collections
 * @property Doctrine_Collection $Bons
 * @property Doctrine_Collection $Commandes
 * 
 * @method integer             getDeviseId()    Returns the current record's "devise_id" value
 * @method string              getNom()         Returns the current record's "nom" value
 * @method string              getPrenom()      Returns the current record's "prenom" value
 * @method string              getEmail()       Returns the current record's "email" value
 * @method string              getTelephone()   Returns the current record's "telephone" value
 * @method double              getCommission()  Returns the current record's "commission" value
 * @method Devise              getDevise()      Returns the current record's "Devise" value
 * @method Doctrine_Collection getCoupes()      Returns the current record's "Coupes" collection
 * @method Doctrine_Collection getCollections() Returns the current record's "Collections" collection
 * @method Doctrine_Collection getBons()        Returns the current record's "Bons" collection
 * @method Doctrine_Collection getCommandes()   Returns the current record's "Commandes" collection
 * @method Commercial          setDeviseId()    Sets the current record's "devise_id" value
 * @method Commercial          setNom()         Sets the current record's "nom" value
 * @method Commercial          setPrenom()      Sets the current record's "prenom" value
 * @method Commercial          setEmail()       Sets the current record's "email" value
 * @method Commercial          setTelephone()   Sets the current record's "telephone" value
 * @method Commercial          setCommission()  Sets the current record's "commission" value
 * @method Commercial          setDevise()      Sets the current record's "Devise" value
 * @method Commercial          setCoupes()      Sets the current record's "Coupes" collection
 * @method Commercial          setCollections() Sets the current record's "Collections" collection
 * @method Commercial          setBons()        Sets the current record's "Bons" collection
 * @method Commercial          setCommandes()   Sets the current record's "Commandes" collection
 * 
 * @package    nathanmode
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCommercial extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('commercial');
        $this->hasColumn('devise_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('nom', 'string', 128, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 128,
             ));
        $this->hasColumn('prenom', 'string', 128, array(
             'type' => 'string',
             'length' => 128,
             ));
        $this->hasColumn('email', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('telephone', 'string', 20, array(
             'type' => 'string',
             'length' => 20,
             ));
        $this->hasColumn('commission', 'double', null, array(
             'type' => 'double',
             ));
        $this->hasColumn('is_super_commercial', 'boolean', null, array(
             'type' => 'boolean',
             'default' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Devise', array(
             'local' => 'devise_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('Coupe as Coupes', array(
             'local' => 'id',
             'foreign' => 'commercial_id'));

        $this->hasMany('Collection as Collections', array(
             'local' => 'id',
             'foreign' => 'commercial_id'));

        $this->hasMany('Bon as Bons', array(
             'local' => 'id',
             'foreign' => 'commercial_id'));

        $this->hasMany('Commande as Commandes', array(
             'local' => 'id',
             'foreign' => 'commercial_id'));
    }
}