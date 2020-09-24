<?php

$pdo->exec(
    'CREATE TABLE IF NOT EXISTS `questions_subscriptions` (
        `s_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
        `s_email` varchar(255) NOT NULL,
        `s_question_id` int(10) unsigned NOT NULL,
        `s_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`s_id`)
    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;'
);
