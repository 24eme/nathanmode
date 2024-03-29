<?php

/**
 * Saison
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    nathanmode
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Saison extends BaseSaison
{

    public function __toString() {

        return $this->libelle;
    }

    public function getSaisonsForAlert() {
      $libelles = array();
      if (preg_match('/([0-9]{4})$/', $this->libelle, $m)) {
        $current = $m[1];
        $currentShort = substr($current, -2);
        $libelles = array(
          'ETE '.($current-2),
          'HIVERS '.($currentShort-2).'/'.($currentShort-1),
          'ETE '.($current-1),
          'HIVERS '.($currentShort-1).'/'.$currentShort,
          'ETE '.$current,
          'HIVERS '.$currentShort.'/'.($currentShort+1),
          'ETE '.($current+1),
        );
      }
      if (preg_match('/([0-9]{2})$/', $this->libelle, $m)) {
        $currentShort = $m[1];
        $current = $currentShort+2000;
        $libelles = array(
          'HIVERS '.($currentShort-3).'/'.($currentShort-2),
          'ETE '.($current-2),
          'HIVERS '.($currentShort-2).'/'.($currentShort-1),
          'ETE '.($current-1),
          'HIVERS '.($currentShort-1).'/'.$currentShort,
          'ETE '.$current,
          'HIVERS '.$currentShort.'/'.($currentShort+1),
        );
      }
      return ($libelles)? SaisonTable::getInstance()->createQuery()->where('libelle IN (?)', implode(',', $libelles))->execute() : null;
    }

}
