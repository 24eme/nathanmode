<?php

class StatutsCredit
{
	
    public static function getListe() {

        return sfConfig::get('app_statuts_credit_liste');
    }
    
    public static function getLibelle($key) {
    	$libelles = self::getListe();
    	return $libelles[$key];
    }
}
