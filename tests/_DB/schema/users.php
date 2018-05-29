<?php

$pdo->exec(
    'CREATE TABLE IF NOT EXISTS `users` (
        `u_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `u_username` varchar(64) UNIQUE NOT NULL,
        `u_name` varchar(250) NOT NULL,
        `u_email` varchar(255) UNIQUE NOT NULL,
        `u_signature` varchar(255) DEFAULT NULL,
        `u_site` varchar(255) DEFAULT NULL,
        `u_password_hash` text NOT NULL,
        `u_api_key` varchar(32) NOT NULL,
        `u_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`u_id`)
    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;'
);
