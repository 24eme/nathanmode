<?php

/**
 * productiondetails module configuration.
 *
 * @package    nathanmode
 * @subpackage productiondetails
 * @author     Your name here
 * @version    SVN: $Id$
 */
class productiondetailsGeneratorConfiguration extends BaseProductiondetailsGeneratorConfiguration
{
    public function getListExport() {
        return ["saison", "fournisseur", "client", "date_commande", "num_commande", "situation", "categorie", "qualite", "colori", "quantite", "prix", "Devise", "nbrelance", "date_livraison_demandee", "date_livraison_prevue", "paiement"];
    }
}
