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
        return ["saison", "fournisseur", "client", "date_commande", "num_commande", "situation", "categorie", "qualite", "colori", "quantite", "prix", "Devise", "nbrelance", "date_livraison_demandee", "date_livraison_prevue", "paiement", "id", "collection_id"];
    }
}
