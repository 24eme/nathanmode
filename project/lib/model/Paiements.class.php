<?php

class Paiements
{
	protected static $_correspondances_jours = array(
      '30_JOURS_NET' => 30,
      '30_JOURS_FIN_DE_MOIS' => 45,
      '30_JOURS_FIN_DE_MOIS_4_ESCOMPTE' => 45,
      '60_JOURS_NET' => 60,
      '60_JOURS_FIN_DE_MOIS' => 75,
      '60_JOURS_FIN_DE_MOIS_10' => 85,
      '90_JOURS_NET' => 90,
      '90_JOURS_LE_MOIS_10' => 115,
      '90_JOURS_FIN_DE_MOIS' => 105,
      '90_JOURS_FIN_DE_MOIS_10' => 115,
      'PAIEMENT_AVANCE' => 0,
      'PAIEMENT_AVANCE_2_PERCENT_ESCOMPTE' => 0,
      'PAIEMENT_AVANCE_3_PERCENT_ESCOMPTE' => 0,
      'PAIEMENT_AVANCE_4_PERCENT_ESCOMPTE' => 0,
      'PAIEMENT_AVANCE_5_PERCENT_ESCOMPTE' => 0,
      'LC' => 0,
      'LC_A_60_JOURS' => 60,
      'LC_A_90_JOURS' => 90,
      'CASH_ON_DELIVERY' => 0
	);
	
    public static function getListe() {

        return sfConfig::get('app_paiements_liste');
    }
    
    public static function getNbJoursByStatut($statut) {
    	$correspondances = self::$_correspondances_jours;
    	return $correspondances[$statut];
    }
}
