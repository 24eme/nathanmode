<?php

class ConditionsPaiement
{
    public static function getListe() {

        return sfConfig::get('app_conditions_paiement_liste');
    }
    
    public static function getLibelle($key) {
    	$libelles = self::getListe();
    	return $libelles[$key];
    }
}
