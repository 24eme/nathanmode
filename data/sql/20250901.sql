ALTER TABLE `collection_detail`
ADD `image` varchar(255) COLLATE 'latin1_swedish_ci' NULL,
ADD `prix_achat` double(18,2) NULL AFTER `image`,
ADD `prix_public` double(18,2) NULL AFTER `prix_achat`,
ADD `part_frais` double(18,2) NULL AFTER `prix_public`,
ADD `part_marge` double(18,2) NULL AFTER `part_frais`,
ADD `part_commission` double(18,2) NULL AFTER `part_marge`,
ADD `date_livraison_prevue` date NULL AFTER `part_commission`;
