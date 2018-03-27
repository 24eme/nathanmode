<?php

class StatutsLabDip
{
    public static function getListe() {

        return sfConfig::get('app_statuts_lab_dip_liste');
    }
    
    public static function getLibelle($key) {
    	$libelles = self::getListe();
    	return $libelles[$key];
    }
}
