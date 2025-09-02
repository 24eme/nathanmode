<?php

class PieceCategories
{
    public static function getListe($withEmpty = false) {
        $appYml = sfYaml::load(sfConfig::get('sf_app_config_dir').'/app.yml');
        $pieceCategorieArray = $appYml['all']['piece_categories']['liste'];
        ksort($pieceCategorieArray);
        return ($withEmpty) ? $pieceCategorieArray +[null => null] : $pieceCategorieArray;;
    }

    public static function getLibelle($key) {
        $libelles = self::getListe();

    	return (isset($libelles[$key]))? $libelles[$key] : null;
    }
}
