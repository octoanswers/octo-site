<?php

$pdo->query(
    'CREATE TABLE IF NOT EXISTS er_users_follow_questions (
        `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
        `user_id` int(11) unsigned NOT NULL,
        `question_id` int(10) unsigned NOT NULL,
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;'
);
