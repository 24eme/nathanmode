<?php

class StatutsBon
{
	const STATUT_EN_ATTENTE = 'EN_ATTENTE';
	const STATUT_ECHUE = 'ECHUE';
	const STATUT_ERREUR = 'ERREUR';
	
    public static function getListe() {
        return array_merge(sfConfig::get('app_statuts_facture_liste'), sfConfig::get('app_statuts_credit_liste'));
    }
    
    public static function getLibelle($key) {
    	$libelles = self::getListe();
    	return $libelles[$key];
    }
}
