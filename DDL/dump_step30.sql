CREATE TABLE `etl_draft_input_data` (
    `id` int NOT NULL AUTO_INCREMENT,
    `extract_session_id` bigint NOT NULL,
    `data_source_id` bigint DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci