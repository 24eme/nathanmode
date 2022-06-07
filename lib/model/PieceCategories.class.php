<?php

class PieceCategories
{
    public static function getListe($withEmpty = false) {

        return ($withEmpty)? sfConfig::get('app_piece_categories_liste')+array(null => null) : sfConfig::get('app_piece_categories_liste');
    }

    public static function getLibelle($key) {
        $libelles = self::getListe();

    	return (isset($libelles[$key]))? $libelles[$key] : null;
    }
}
