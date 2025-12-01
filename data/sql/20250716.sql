ALTER TABLE `collection_detail` ADD `image` varchar(255) COLLATE 'latin1_swedish_ci' NULL;
ALTER TABLE `collection_detail` ADD COLUMN `prix_achat` double(18, 2) NULL DEFAULT NULL;
ALTER TABLE `collection_detail` ADD COLUMN `prix_public` double(18, 2) NULL DEFAULT NULL;
ALTER TABLE `collection_detail` ADD COLUMN `part_frais` double(18, 2) NULL DEFAULT NULL;
ALTER TABLE `collection_detail` ADD COLUMN `part_marge` double(18, 2) NULL DEFAULT NULL;
