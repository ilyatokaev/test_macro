/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `agency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `agency` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contacts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phones` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `estate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estate` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `rooms` int NOT NULL,
  `floor` int NOT NULL,
  `house_floors` int NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_id` bigint unsigned NOT NULL,
  `manager_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `estate_contact_id_foreign` (`contact_id`),
  KEY `estate_manager_id_foreign` (`manager_id`),
  CONSTRAINT `estate_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`),
  CONSTRAINT `estate_manager_id_foreign` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `manager`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `manager` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agency_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `manager_agency_id_foreign` (`agency_id`),
  CONSTRAINT `manager_agency_id_foreign` FOREIGN KEY (`agency_id`) REFERENCES `agency` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `etl_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `etl_sessions` (
                                `id` bigint NOT NULL AUTO_INCREMENT,
                                `type_code` VARCHAR(15) NULL,
                                `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
                                `comment` text COLLATE utf8mb4_unicode_ci,
                                PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

ALTER TABLE `agency`
    ADD COLUMN `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    ADD COLUMN `updated_at` DATETIME NULL AFTER `created_at`,
    ADD COLUMN `last_etl_session_id` BIGINT NULL AFTER `updated_at`,
    ADD COLUMN `data_source_id` BIGINT DEFAULT NULL AFTER `last_etl_session_id`,
    ADD COLUMN `source_instance_code` VARCHAR(255) NULL;

ALTER TABLE `contacts`
    ADD COLUMN `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    ADD COLUMN `updated_at` DATETIME NULL AFTER `created_at`,
    ADD COLUMN `last_etl_session_id` BIGINT NULL AFTER `updated_at`,
    ADD COLUMN `data_source_id` BIGINT DEFAULT NULL AFTER `last_etl_session_id`,
    ADD COLUMN `source_instance_code` VARCHAR(255) NULL;

ALTER TABLE `estate`
    ADD COLUMN `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    ADD COLUMN `updated_at` DATETIME NULL AFTER `created_at`,
    ADD COLUMN `last_etl_session_id` BIGINT NULL AFTER `updated_at`,
    ADD COLUMN `data_source_id` BIGINT DEFAULT NULL AFTER `last_etl_session_id`,
    ADD COLUMN `source_instance_code` VARCHAR(255) NULL;


ALTER TABLE `manager`
    ADD COLUMN `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    ADD COLUMN `updated_at` DATETIME NULL AFTER `created_at`,
    ADD COLUMN `last_etl_session_id` BIGINT NULL AFTER `updated_at`,
    ADD COLUMN `data_source_id` BIGINT DEFAULT NULL AFTER `last_etl_session_id`,
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
    ADD UNIQUE INDEX `agency_unique_source_instance_code` USING BTREE (`source_instance_code`) VISIBLE;
ALTER TABLE `contacts`
    ADD UNIQUE INDEX `contacts_unique_source_instance_code` USING BTREE (`source_instance_code`) VISIBLE;
ALTER TABLE `estate`
    ADD UNIQUE INDEX `estate_unique_source_instance_code` USING BTREE (`source_instance_code`) VISIBLE;
ALTER TABLE `manager`
    ADD UNIQUE INDEX `manager_unique_source_instance_code` USING BTREE (`source_instance_code`, `agency_id`) VISIBLE;


DROP TABLE IF EXISTS `etl_draft_input_data`;
CREATE TABLE `etl_draft_input_data` (
                                        `id` int NOT NULL AUTO_INCREMENT,
                                        `extract_session_id` bigint NOT NULL,
                                        `parse_status` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                        `agency_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                        `manager_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                        `contact_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                        `contact_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                        `estate_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                        `estate_price` int DEFAULT NULL,
                                        `estate_description` text COLLATE utf8mb4_unicode_ci,
                                        `estate_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                        `estate_floor` int DEFAULT NULL,
                                        `estate_house_floor` int DEFAULT NULL,
                                        `estate_rooms` int DEFAULT NULL,
                                        `draft_data` text COLLATE utf8mb4_unicode_ci,
                                        `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                        `transform_session_id` bigint DEFAULT NULL,
                                        PRIMARY KEY (`id`),
                                        KEY `etl_draft_input_data_fk_transform_session_id_idx` (`transform_session_id`),
                                        KEY `etl_draft_input_data_fk_extract_session_id_idx` (`extract_session_id`),
                                        CONSTRAINT `etl_draft_input_data_fk_extract_session_id` FOREIGN KEY (`extract_session_id`) REFERENCES `etl_sessions` (`id`),
                                        CONSTRAINT `etl_draft_input_data_fk_transform_session_id` FOREIGN KEY (`transform_session_id`) REFERENCES `etl_sessions` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `etl_draft_input_data_for_update`;
CREATE TABLE `etl_draft_input_data_for_update` (
                                                   `id` int NOT NULL AUTO_INCREMENT,
                                                   `extract_session_id` bigint NOT NULL,
                                                   `parse_status` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                                   `agency_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                                   `manager_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                                   `contact_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                                   `contact_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                                   `estate_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                                   `estate_price` int DEFAULT NULL,
                                                   `estate_description` text COLLATE utf8mb4_unicode_ci,
                                                   `estate_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                                   `estate_floor` int DEFAULT NULL,
                                                   `estate_house_floor` int DEFAULT NULL,
                                                   `estate_rooms` int DEFAULT NULL,
                                                   `draft_data` text COLLATE utf8mb4_unicode_ci,
                                                   `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                                   `transform_session_id` bigint DEFAULT NULL,
                                                   PRIMARY KEY (`id`),
                                                   KEY `etl_draft_input_data_for_update_fk_transform_session_id_idx` (`transform_session_id`),
                                                   KEY `etl_draft_input_data_for_update_fk_extract_session_id_idx` (`extract_session_id`),
                                                   CONSTRAINT `etl_draft_input_data_for_update_fk_extract_session_id` FOREIGN KEY (`extract_session_id`) REFERENCES `etl_sessions` (`id`),
                                                   CONSTRAINT `etl_draft_input_data_for_update_fk_transform_session_id` FOREIGN KEY (`transform_session_id`) REFERENCES `etl_sessions` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;