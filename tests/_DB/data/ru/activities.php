<?php

$pdo->query(
    "INSERT INTO activities (id, u_id, h_id, q_id, activity_type, data, created_at) VALUES
        (1, 5, NULL, NULL, 'followed_U_write_A', '{\"category\":{\"id\": 3}, \"question\": {\"id\": 13}}', '2015-11-29 09:28:34'),
        (2, 4, NULL, NULL, 'followed_U_write_A', '{\"category\":{\"id\": 3}, \"question\": {\"id\": 13}}', '2015-11-29 09:28:34'),
        (3, 7, NULL, NULL, 'followed_U_follow_H', '{\"category\":{\"id\": 3}, \"question\": {\"id\": 13}}', '2015-11-29 09:28:34'),
        (4, 4, NULL, NULL, 'followed_U_follow_U', '{\"category\":{\"id\": 3}, \"question\": {\"id\": 13}}', '2015-11-29 09:28:34'),
        (5, NULL, 3, NULL, 'followed_H_added_Q', '{\"category\":{\"id\": 3}, \"question\": {\"id\": 13}}', '2015-11-29 09:28:34'),
        (6, NULL, NULL, 13, 'followed_Q_added_A', '{\"question\": {\"id\": 5}, \"answer\": {\"id\": 14}}', '2015-11-29 09:28:34'),
        (7, 5, NULL, NULL, 'followed_U_write_A', '{\"user\": {\"id\": 5}, \"answer\": {\"id\": 14}}', '2015-11-29 09:28:34'),
        (8, NULL, NULL, 4, 'followed_Q_added_A', '{\"category\":{\"id\": 3}, \"question\": {\"id\": 13}}', '2015-11-29 09:28:34'),
        (9, NULL, NULL, 13, 'followed_Q_added_A', '{\"category\":{\"id\": 3}, \"question\": {\"id\": 13}}', '2015-11-29 09:28:34'),
        (10, 9, NULL, NULL, 'followed_U_repost_Q', '{\"category\":{\"id\": 3}, \"question\": {\"id\": 13}}', '2015-11-28 09:38:34'),
        (11, 9, NULL, NULL, 'followed_U_repost_A', '{\"category\":{\"id\": 3}, \"question\": {\"id\": 13}}', '2015-11-29 19:28:34'),
        (12, NULL, 3, NULL, 'followed_H_got_achievement', '{\"category\":{\"id\": 3}, \"achievement\": {\"type\": \"100_followers\"}}', '2015-11-29 09:28:34');"
);
