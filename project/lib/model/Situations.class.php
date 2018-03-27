<?php

class Situations
{
	const SITUATION_SOLDEE = 'SOLDEE';
	const SITUATION_ECRU_DESIGNER = 'ECRU_DESIGNER';
	const SITUATION_ECRU_A_DESIGNER = 'ECRU_A_DESIGNER';
	protected static $_situations_historique = array(
		"INSPECTION_COTECO" =>  "Inspection coteco",
	);
	
    public static function getListe() {

        return sfConfig::get('app_situations_liste');
    }
    
    public static function getLibelle($key) {
    	$libelles = array_merge(self::getListe(), self::$_situations_historique);
    	return (isset($libelles[$key]))? $libelles[$key] : null;
    }
}
