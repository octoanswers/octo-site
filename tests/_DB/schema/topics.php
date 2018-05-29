<?php

$pdo->query(
    "CREATE TABLE IF NOT EXISTS topics (
        t_id int(10) unsigned NOT NULL AUTO_INCREMENT,
        t_title varchar(255) UNIQUE NOT NULL,
        t_words text,
        PRIMARY KEY (`t_id`)
    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;"
);
