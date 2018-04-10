<?php

class Statuts
{
    public static function getListe() {

        return sfConfig::get('app_statuts_liste');
    }
}
