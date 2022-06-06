ALTER TABLE `coupe` ADD COLUMN `situation` varchar(128) NULL DEFAULT NULL;
ALTER TABLE `coupe` ADD COLUMN `prix` double(18, 2) NULL DEFAULT NULL;
ALTER TABLE `coupe` ADD COLUMN `num_commande` varchar(128) NULL DEFAULT NULL;
UPDATE coupe SET date_commande = livre_le WHERE date_commande IS NULL;
UPDATE coupe SET situation = 'SOLDEE' WHERE situation IS NULL;