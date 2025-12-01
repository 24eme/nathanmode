<?php

class ConditionsPaiement
{
    public static function getListe() {

        return sfConfig::get('app_conditions_paiement_liste');
    }

    public static function getLibelle($key) {
    	$libelles = self::getListe();
        if(!isset($libelles[$key])) {
            return $key;
        }
    	return $libelles[$key];
    }
}
