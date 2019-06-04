<?php

$pdo->exec(
    "INSERT INTO categories (h_id, h_title, h_words) VALUES
    (1, 'English literature', 'Lermontov Pushkin'),
    (2, 'Test', NULL),
    (3, 'Decoration Materials', NULL),
    (4, 'Cars', NULL),
    (5, 'Moscow', NULL),
    (6, 'Motor sport', 'формула_1 михаэль_шумахер'),
    (7, 'Cosmetics', NULL),
    (8, 'Parfum', 'рив_гош духи духами помада'),
    (9, 'Soil science', 'soil'),
    (10, 'Religion', 'секуляризация'),
    (11, 'Porridge', NULL),
    (12, 'Cashmere', NULL),
    (13, 'Birds', 'голубь птицы птица'),
    (14, 'Nature', 'живой_природы'),
    (15, 'BMW i7', 'bmw_i7'),
    (16, 'Photography', 'фото объектив'),
    (17, 'Photosynthez', 'фотосинтез');"
);
