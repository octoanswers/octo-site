<?php

$pdo->exec(
    'CREATE TABLE IF NOT EXISTS `er_categories_questions` (
        `er_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
        `er_category_id` int(10) unsigned NOT NULL,
        `er_question_id` int(10) unsigned NOT NULL,
        `er_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`er_id`)
    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;'
);
