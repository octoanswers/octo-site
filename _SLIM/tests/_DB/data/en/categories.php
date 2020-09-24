<?php

$pdo->exec(
    "INSERT INTO categories (c_id, c_title, c_words, cat_is_redirect) VALUES
    (1, 'English literature', 'Lermontov Pushkin', 0),
    (2, 'Test', NULL, 0),
    (3, 'Decoration Materials', NULL, 0),
    (4, 'Cars', NULL, 0),
    (5, 'Moscow', NULL, 0),
    (6, 'Motor sport', 'формула_1 михаэль_шумахер', 0),
    (7, 'Cosmetics', NULL, 0),
    (8, 'Parfum', 'рив_гош духи духами помада', 0),
    (9, 'Soil science', 'soil', 0),
    (10, 'Religion', 'секуляризация', 0),
    (11, 'Porridge', NULL, 0),
    (12, 'Cashmere', NULL, 0),
    (13, 'Birds', 'голубь птицы птица', 0),
    (14, 'Nature', 'живой_природы', 0),
    (15, 'BMW i7', 'bmw_i7', 0),
    (16, 'Photography', 'фото объектив', 0),
    (17, 'Photosynthez', 'фотосинтез', 0),
    (18, 'Photo synthez', NULL, 1);"
);
