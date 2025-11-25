ALTER TABLE `collection_detail`
ADD `date_livraison_demandee` date NULL;

ALTER TABLE `collection_retard`
ADD `piece_categorie` varchar(128) COLLATE 'latin1_swedish_ci' NULL,
ADD `qualite` varchar(128) COLLATE 'latin1_swedish_ci' NULL,
ADD `colori` varchar(128) COLLATE 'latin1_swedish_ci' NULL;
