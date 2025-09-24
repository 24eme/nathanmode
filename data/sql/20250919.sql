-- INSERT INTO `devise` (`libelle`, `symbole`, `is_pourcentage`)
-- VALUES ('Calculé automatiquement avec la marge', '%', '1');
ALTER TABLE `collection`
ADD `part_marge` double(18,2) NULL AFTER `prix_fournisseur`
