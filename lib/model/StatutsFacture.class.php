<?php

class StatutsFacture
{
	//const KEY_EN_ATTENTE = 'EN_ATTENTE';
	//const KEY_ECHUE = 'ECHUE';
	const KEY_PAYEE = 'PAYEE';
	const KEY_NON_PAYEE = 'NON_PAYEE';
	
    public static function getListe() {

        return sfConfig::get('app_statuts_facture_liste');
    }
	
    public static function getListeNonPayee() {
		$liste = self::getListe();
		unset($liste[self::KEY_PAYEE]);
        return $liste;
    }
    
    public static function getLibelle($key) {
    	$libelles = self::getListe();
    	return $libelles[$key];
    }
}
