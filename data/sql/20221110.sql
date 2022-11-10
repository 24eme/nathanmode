ALTER TABLE coupe DROP FOREIGN KEY coupe_ibfk_1;
ALTER TABLE coupe DROP FOREIGN KEY coupe_ibfk_2;

ALTER TABLE coupe MODIFY facture_id bigint(20) NULL;
ALTER TABLE coupe MODIFY commande_id bigint(20) NULL;
