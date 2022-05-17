ALTER TABLE `bon` ADD COLUMN `collection_id` bigint(20) NULL;
ALTER TABLE bon ADD CONSTRAINT bon_collection_id_collection_id FOREIGN KEY (collection_id) REFERENCES collection(id) ON DELETE CASCADE;