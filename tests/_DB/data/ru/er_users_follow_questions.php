<?php

$pdo->query(
    "INSERT INTO er_users_follow_questions (id, user_id, question_id, created_at) VALUES
        (1, 13, 30, '2016-05-06 09:47:51'),
        (2, 7,  22, '2016-05-06 09:48:24'),
        (3, 3,  7,  '2015-12-16 13:28:56'),
        (4, 67, 22, '2016-05-06 09:48:24'),
        (5, 7,  23, '2015-12-16 13:28:56'),
        (6, 18, 23, '2015-12-16 13:28:56'),
        (7, 9,  7,  '2015-12-16 13:28:56'),
        (8, 4,  4,  '2015-12-16 13:28:56');"
);