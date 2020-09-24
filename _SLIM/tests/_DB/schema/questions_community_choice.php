<?php

$pdo->query(
    'CREATE TABLE IF NOT EXISTS `questions_community_choice` (
        `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
        `q_id` int(10) UNSIGNED NOT NULL,
        `added_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;'
);
