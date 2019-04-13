<?php

$pdo->query(
    "CREATE TABLE IF NOT EXISTS hashtags (
        h_id int(10) unsigned NOT NULL AUTO_INCREMENT,
        h_title varchar(255) UNIQUE NOT NULL,
        h_words text,
        PRIMARY KEY (`h_id`)
    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;"
);
