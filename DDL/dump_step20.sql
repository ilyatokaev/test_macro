ALTER TABLE `agency`
    ADD COLUMN `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    ADD COLUMN `updated_at` DATETIME NULL AFTER `created_at`,
    ADD COLUMN `last_etl_session_id` BIGINT NULL AFTER `updated_at`,
    ADD COLUMN `data_source_id` BIGINT NOT NULL AFTER `last_etl_session_id`,
    ADD COLUMN `source_instance_code` VARCHAR(255) NULL;

ALTER TABLE `contacts`
    ADD COLUMN `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    ADD COLUMN `updated_at` DATETIME NULL AFTER `created_at`,
    ADD COLUMN `last_etl_session_id` BIGINT NULL AFTER `updated_at`,
    ADD COLUMN `data_source_id` BIGINT NOT NULL AFTER `last_etl_session_id`,
    ADD COLUMN `source_instance_code` VARCHAR(255) NULL;

ALTER TABLE `estate`
    ADD COLUMN `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    ADD COLUMN `updated_at` DATETIME NULL AFTER `created_at`,
    ADD COLUMN `last_etl_session_id` BIGINT NULL AFTER `updated_at`,
    ADD COLUMN `data_source_id` BIGINT NOT NULL AFTER `last_etl_session_id`,
    ADD COLUMN `source_instance_code` VARCHAR(255) NULL;


ALTER TABLE `manager`
    ADD COLUMN `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    ADD COLUMN `updated_at` DATETIME NULL AFTER `created_at`,
    ADD COLUMN `last_etl_session_id` BIGINT NULL AFTER `updated_at`,
    ADD COLUMN `data_source_id` BIGINT NOT NULL AFTER `last_etl_session_id`,
    ADD COLUMN `source_instance_code` VARCHAR(255) NULL;

ALTER TABLE `agency`
    ADD CONSTRAINT `agency_fk_last_etl_session_id`
        FOREIGN KEY (`last_etl_session_id`)
            REFERENCES `etl_sessions` (`id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION,
    ADD CONSTRAINT `agency_fk_last_data_source_id`
        FOREIGN KEY (`last_etl_session_id`)
            REFERENCES `etl_sessions` (`id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION
;

ALTER TABLE `contacts`
    ADD CONSTRAINT `contacts_fk_last_etl_session_id`
        FOREIGN KEY (`last_etl_session_id`)
            REFERENCES `etl_sessions` (`id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION,
    ADD CONSTRAINT `contacts_fk_last_data_source_id`
        FOREIGN KEY (`last_etl_session_id`)
            REFERENCES `etl_sessions` (`id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION
;

ALTER TABLE `estate`
    ADD CONSTRAINT `estate_fk_last_etl_session_id`
        FOREIGN KEY (`last_etl_session_id`)
            REFERENCES `etl_sessions` (`id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION,
    ADD CONSTRAINT `estate_fk_last_data_source_id`
        FOREIGN KEY (`last_etl_session_id`)
            REFERENCES `etl_sessions` (`id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION
;

ALTER TABLE `manager`
    ADD CONSTRAINT `manager_fk_last_etl_session_id`
        FOREIGN KEY (`last_etl_session_id`)
            REFERENCES `etl_sessions` (`id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION,
    ADD CONSTRAINT `manager_fk_last_data_source_id`
        FOREIGN KEY (`last_etl_session_id`)
            REFERENCES `etl_sessions` (`id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION
;

ALTER TABLE `agency`
    ADD UNIQUE INDEX `agency_unique_source_instance_code` USING BTREE (`data_source_id`, `source_instance_code`) VISIBLE;
ALTER TABLE `contacts`
    ADD UNIQUE INDEX `contacts_unique_source_instance_code` USING BTREE (`data_source_id`, `source_instance_code`) VISIBLE;
ALTER TABLE `estate`
    ADD UNIQUE INDEX `estate_unique_source_instance_code` USING BTREE (`data_source_id`, `source_instance_code`) VISIBLE;
ALTER TABLE `manager`
    ADD UNIQUE INDEX `manager_unique_source_instance_code` USING BTREE (`data_source_id`, `source_instance_code`) VISIBLE;
