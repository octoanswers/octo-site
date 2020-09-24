<?php

$pdo->query(
    'CREATE TABLE IF NOT EXISTS `redirects_questions` (
        `rd_from` int(10) UNSIGNED NOT NULL,
        `rd_title` varchar(255) NOT NULL,
        PRIMARY KEY (`rd_from`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;'
);
