ALTER TABLE `coupe` ADD `fichier_confirmation` VARCHAR(255) NULL AFTER `nb_relance`;


CREATE TABLE commercial_activity_logger(id BIGINT(20) PRIMARY KEY NOT NULL AUTO_INCREMENT, date_log DATETIME NOT NULL, ca DOUBLE(18,2), com DOUBLE(18,2), mts DOUBLE(18,2), acces DOUBLE(18,2), pf_cn DOUBLE(18,2));
