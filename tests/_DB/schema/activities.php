<?php

$pdo->query(
    'CREATE TABLE IF NOT EXISTS activities (
      id int(10) unsigned NOT NULL AUTO_INCREMENT,
      u_id int(11) unsigned DEFAULT NULL,
      c_id int(10) unsigned DEFAULT NULL,
      q_id int(10) unsigned DEFAULT NULL,
      activity_type varchar(32) NOT NULL,
      data text NOT NULL,
      created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
      PRIMARY KEY (`id`)
    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;'
);
