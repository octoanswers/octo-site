<?php

$pdo->query(
    "INSERT INTO questions (q_id, q_title, q_is_redirect, q_image_base_name, a_text, a_hashtags, a_len, a_updated_at) VALUES
    (1, 'Какой бывает дождь?', 0, NULL, 'Он бывает разных типов.', NULL, 23, '2015-11-29 09:28:34'),
    (2, 'Как продать франшизу?', 0, NULL, NULL, NULL, 0, '2015-11-29 09:28:34'),
    (3, 'Какие купить духи?', 0, NULL, NULL, NULL, 0, '2015-11-29 09:28:34'),
    (4, 'Чем занимается гинеколог?', 0, NULL, '#медицина', '[\"Медицина\"]', 9, '2015-11-29 09:28:34'),
    (5, 'В чем драматизм человека?', 0, '4_2066_05_09_123', NULL, NULL, 0, '2015-11-29 09:28:34'),
    (6, 'Как птицы помечают свою территорию?', 0, '4_2013_05_09_123', 'Птицы не помечают свою территорию.', '[\"iPhone 8\",\"Apple\"]', 0, '2015-11-29 09:28:34'),
    (7, 'Какую роль играет почва во взаимосвязи неживой и живой природы?', 0, NULL, NULL, NULL, 0, '2015-11-29 09:28:34'),
    (8, 'Как дела?', 0, NULL, NULL, NULL, 0, '2015-11-29 09:28:34'),
    (9, 'Где получить ответ на вопрос?', 0, '1_000_4', NULL, NULL, 0, '2015-11-29 09:28:34'),
    (10, 'Как отрастить бороду?', 0, NULL, NULL, NULL, 0, '2015-11-29 09:28:34'),
    (11, 'Часто ли птица поет песни?', 1, NULL, NULL, NULL, 0, '2015-11-29 09:28:34'),
    (12, 'Огонь уничтожает кровь?', 0, NULL, 'В одной документалке сказали, что нет #огонь #улики', NULL, 51, '2015-11-29 09:28:34'),
    (13, 'Как птицы делают игры?', 0, NULL, NULL, NULL, 0, '2015-11-29 09:28:34'),
    (14, 'Как ты?', 0, '1_000_3', 'I`m fine, bro!', NULL, 14, '2015-11-29 09:28:34'),
    (15, 'Где я родился?', 0, NULL, 'ЕКБ', NULL, 2, '2015-11-29 09:28:34'),
    (16, 'Как часто птицы поют песни?', 0, NULL, 'Это первый ответ длинна которого составляет более 50 символов.', NULL, 61, '2015-11-29 09:28:34'),
    (17, 'Кто владеет компаний Apple после смерти Стива Джобса?', 0, NULL, NULL, NULL, 0, '2015-11-29 09:28:34'),
    (18, 'Кто лучший драматический актер?', 0, NULL, NULL, NULL, 0, '2015-11-29 09:28:34'),
    (19, 'Огонь уничтожает ДНК?', 0, NULL, NULL, NULL, 0, '2015-11-29 09:28:34'),
    (20, 'Как разработчики делают интересные игры?', 0, NULL, '#Games', NULL, 6, '2017-10-29 09:28:34'),
    (21, 'Как птицы делают видеоигры?', 0, NULL, 'Никто не знает как птицы делают игры.', NULL, 0, '2015-11-29 09:28:34'),
    (22, 'Чем модульное тестирование отличается от интеграционного?', 0, NULL, NULL, NULL, 0, '2015-11-29 09:28:34'),
    (23, 'Как армия тренирует солдат?', 0, NULL, NULL, NULL, 0, '2015-11-29 09:28:34'),
    (24, 'Расскажете о своем опыте в области управления проектами?', 0, NULL, 'Hmm, it`s a long-long story...', NULL, 30, '2015-11-29 09:28:34'),
    (25, 'Какова цена iPhone 6?', 0, '1_000_2', 'Это второй ответ длинна которого составляет более 50 символов.', NULL, 62, '2015-11-29 09:28:34'),
    (26, 'Каков максимальный номер ID в MySQL?', 0, NULL, NULL, NULL, 0, '2015-11-29 09:28:34'),
    (27, 'Чем светский гуманизм отличается от атеизма?', 0, NULL, NULL, NULL, 0, '2015-11-29 09:28:34'),
    (28, 'Вам нравится iPhone 6?', 0, NULL, NULL, NULL, 0, '2015-11-29 09:28:34'),
    (29, 'Чем президенты занимаются в выходные?', 0, '1_000_1', NULL, NULL, 0, '2015-11-29 09:28:34'),
    (30, 'А мальчик-то был?', 1, NULL, NULL, NULL, 0, '2015-11-29 09:28:34'),
    (31, 'Какая сейчас погода?', 0, NULL, NULL, NULL, 0, '2015-11-29 09:28:34'),
    (32, 'Чем отличается проектная деятельность от операционной в области ИТ?', 0, NULL, 'There are a lot of differences.', NULL, 31, '2015-11-29 09:28:34'),
    (33, 'Птицы играют в игры?', 0, NULL, 'Нет, не играют.', NULL, 32, '2017-11-29 09:28:34');"
);
