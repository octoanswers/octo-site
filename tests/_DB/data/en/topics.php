<?php

$pdo->exec(
    "INSERT INTO topics (t_id, t_title, t_words) VALUES
    (1, 'русскаялитература', 'лермонтов пушкин'),
    (2, 'тест', NULL),
    (3, 'отделочныематериалы', NULL),
    (4, 'автомобили', NULL),
    (5, 'moscow', NULL),
    (6, 'автоспорт', 'формула_1 михаэль_шумахер'),
    (7, 'косметика', NULL),
    (8, 'parfum', 'рив_гош духи духами помада'),
    (9, 'почвоведение', 'почва'),
    (10, 'религия', 'секуляризация'),
    (11, 'каша', NULL),
    (12, 'кашемир', NULL),
    (13, 'птицы', 'голубь птицы птица'),
    (14, 'живаяприрода', 'живой_природы'),
    (15, 'bmwi7', 'bmw_i7'),
    (16, 'фотография', 'фото объектив'),
    (17, 'photosynthez', 'фотосинтез');"
);
