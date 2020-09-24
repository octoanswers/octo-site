<?php

$pdo->query(
    "INSERT INTO `questions_subscriptions` (`s_id`, `s_question_id`, `s_email`, `s_created_at`) VALUES
        (1, 236, 'first@test.ru', '2016-05-06 09:47:51'),
        (2, 236, 'data@test.ru',  '2016-05-06 09:48:24'),
        (3, 7,  'data@test.ru',  '2015-12-16 13:24:26'),
        (4, 186, 'data@test.ru',  '2015-12-16 13:24:56');"
);
