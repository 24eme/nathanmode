ALTER TABLE `collection_detail`
ADD `image` varchar(255) COLLATE 'latin1_swedish_ci' NULL,
ADD `prix_achat` double(18,2) NULL AFTER `image`,
ADD `prix_public` double(18,2) NULL AFTER `prix_achat`,
ADD `part_frais` double(18,2) NULL AFTER `prix_public`,
ADD `date_livraison_prevue` date NULL AFTER `prix_public`;
