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
    `id` bigint NOT NULL,
    `type_code` VARCHAR(15) NULL,
    `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
    `comment` text COLLATE utf8mb4_unicode_ci,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

DROP TABLE IF EXISTS `data_sources`;
CREATE TABLE `data_sources` (
    `id` bigint NOT NULL AUTO_INCREMENT,
    `code` VARCHAR(255) NULL,
    `name` VARCHAR(255) NULL,
    `description` TEXT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `etl_handled_files`;
CREATE TABLE `etl_handled_files` (
    `id` BIGINT NOT NULL AUTO_INCREMENT,
    `data_source_id` BIGINT NOT NULL,
    `source_file_name` VARCHAR(255) NULL,
    `source_file_hash` VARCHAR(255) NULL,
    `target_file_name` VARCHAR(255) NULL,
    `etl_session_id` BIGINT NULL,
    PRIMARY KEY (`id`),
    INDEX `fk_etl_handlers_files_etl_session_id_idx` (`etl_session_id` ASC) VISIBLE,
    CONSTRAINT `fk_etl_handled_files_data_source_id`
        FOREIGN KEY (`data_source_id`)
            REFERENCES `data_sources` (`id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION,
    CONSTRAINT `fk_etl_handlers_files_etl_session_id`
        FOREIGN KEY (`etl_session_id`)
            REFERENCES `etl_sessions` (`id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION);
