ALTER TABLE `collection_detail`
ADD `date_livraison_demandee` date NULL,
ADD `commande_soldee` TINYINT(1) NOT NULL DEFAULT 0;

ALTER TABLE `collection_retard`
ADD `piece_categorie` varchar(128) COLLATE 'latin1_swedish_ci' NULL,
ADD `qualite` varchar(128) COLLATE 'latin1_swedish_ci' NULL,
ADD `colori` varchar(128) COLLATE 'latin1_swedish_ci' NULL;
