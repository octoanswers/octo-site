<?php

$pdo->query(
    "CREATE TABLE IF NOT EXISTS `questions` (
        `q_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
        `q_title` varchar(255) UNIQUE NOT NULL,
        `q_is_redirect` tinyint(1) NOT NULL DEFAULT '0',
        `q_image_base_name` varchar(64) DEFAULT NULL,
        `a_text` MEDIUMTEXT DEFAULT NULL,
        `a_hashtags` TEXT DEFAULT NULL,
        `a_len` int(10) unsigned NOT NULL DEFAULT '0',
        `a_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`q_id`)
    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;"
);
