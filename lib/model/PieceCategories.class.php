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

        if(!$key) {
            return null;
        }
    	return (isset($libelles[$key]))? $libelles[$key] : $key;
    }

    public function getGroupedListe($withEmpty = false) {
        $liste = self::getListe($withEmpty);
        $groupedListe = [];
        foreach($liste as $key => $libelle) {
            $groupKey = $key;
            if(count(explode("_", $groupKey))) {
                $groupKey = explode("_", $groupKey)[0];
            }
            $groupedListe[$groupKey][$key] = $libelle;
        }

        return $groupedListe;
    }
}
