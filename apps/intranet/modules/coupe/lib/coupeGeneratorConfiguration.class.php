<?php

/**
 * coupe module configuration.
 *
 * @package    nathanmode
 * @subpackage coupe
 * @author     Your name here
 * @version    SVN: $Id: configuration.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class coupeGeneratorConfiguration extends BaseCoupeGeneratorConfiguration
{
    public function getListExport() {
        return ["date_commande", "Saison", "Fournisseur", "Client", "tissu", "colori", "piece_categorie", "piece", "metrage", "date_livraison", "num_facture", "situation", "nb_relance", "fichier", "fichier_confirmation", "id", "commande_id", "facture_id"];
    }
}
