<?php

$pdo->query(
    'CREATE TABLE IF NOT EXISTS `revisions` (
        `rev_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
        `rev_answer_id` int(10) UNSIGNED NOT NULL,
        `rev_opcodes` text NOT NULL,
        `rev_base_text` MEDIUMTEXT DEFAULT NULL,
        `rev_comment` varchar(255) DEFAULT NULL,
        `rev_parent_id` int(10) UNSIGNED DEFAULT NULL,
        `rev_user_id` int(11) unsigned NOT NULL,
        `rev_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`rev_id`)
    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;'
);
