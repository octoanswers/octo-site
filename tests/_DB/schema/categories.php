<?php

$pdo->query(
    "CREATE TABLE IF NOT EXISTS categories (
        c_id int(10) unsigned NOT NULL AUTO_INCREMENT,
        c_title varchar(255) UNIQUE NOT NULL,
        c_words text,
        PRIMARY KEY (`c_id`)
    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;"
);
