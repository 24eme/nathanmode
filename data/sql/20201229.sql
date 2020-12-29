ALTER TABLE `coupe`
ADD `piece_categorie` varchar(128) COLLATE 'latin1_swedish_ci' NULL AFTER `metrage`;
ALTER TABLE `commande`
ADD `piece_categorie` varchar(128) COLLATE 'latin1_swedish_ci' NULL AFTER `metrage`;
ALTER TABLE `bon`
ADD `piece_categorie` varchar(128) COLLATE 'latin1_swedish_ci' NULL AFTER `metrage`;
ALTER TABLE `collection_detail`
ADD `piece_categorie` varchar(128) COLLATE 'latin1_swedish_ci' NULL AFTER `metrage`;
ALTER TABLE `collection_livraison`
ADD `piece_categorie` varchar(128) COLLATE 'latin1_swedish_ci' NULL AFTER `metrage`;
