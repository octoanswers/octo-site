<?php

$pdo->exec(
  "INSERT INTO `users` (`u_id`, u_username, `u_name`, `u_email`, u_signature, u_site, `u_password_hash`, `u_api_key`, u_created_at) VALUES
  (1, 'gomzyakov', 'Александр Гомзяков', 'alexander.gomzyakov@gmail.com', NULL, NULL, '$2a$10$91968b5d5b465b37e8630eRtP9A.XoWkOP3xVDv6zYpOdhLr/ToIW', '34b88c8f1ed16fdcc18d93667c886fcc', '2016-02-24 08:00:52'),
  (2, 'cheremshov', 'Сява Черемшов', 'syava@gmail.ru', NULL, NULL, '$2a$10$6f28824558c757fb675c4eLiXg4mEsZUoZGy8iE1k89mrynOn/QHG', '123ae73181eea730380ef0c225b50f68', '2016-02-11 16:03:50'),
  (3, 'ivan', 'Иван Коршунов', 'admin@answeropedia.org', 'Old signature', NULL, '$2a$10$302c3a67fccf3f2c3b7a3ejzYNi6hadZm3abINiiGlcT03Kau4XAO', '7d21ebdbec3d4e396043c96b6ab44a6e', '2016-03-19 06:47:41'),
  (4, 'sasha', 'Александр Пушкин', 'pushka@answeropedia.org', 'Известный писатель', NULL, '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy', '9447243e3e1706375d23b06bf6dd1271', '2016-02-26 16:00:46'),
  (5, 'vika', 'Вика Ослова', 'vika@answeropedia.org', NULL, NULL, '$2a$10$302c3a67fccf3f2c3b7a3ejzYNi6hadZm3abINiiGlcT03Kau4XAO', '7d21eXXXec3d4e396043c96b6ab44a6e', '2016-03-19 06:47:41'),
  (6, 'kozel', 'Виталий Козлов', 'vitali@answeropedia.org', NULL, NULL, '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy', '4447243e3e1766375d23b06bf6dd1271', '2016-02-26 16:00:46'),
  (7, 'perepel', 'Павел Перепелов', 'perepel@answeropedia.org', NULL, NULL, '$2a$10$302c3a67fccf3f2c3b7a3ejzYNi6hadZm3abINiiGlcT03Kau4XAO', '7d21ebdbec3d4e677843c96b6ab44a6e', '2016-03-19 06:47:41'),
  (8, 'jora', 'Жора Бегемотов', 'jora@answeropedia.org', NULL, NULL, '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy', '9447222e3e1706375d23b06bf6dd1271', '2016-02-26 16:00:46'),
  (9, 'kira', 'Кира Найтли', 'kira@answeropedia.org', NULL, NULL, '$2a$10$302c3a67fccf3f2c3b7a3ejzYNi6hadZm3abINiiGlcT03Kau4XAO', '7d21ebdbec3dxxcc6043c96b6ab44a6e', '2016-03-19 06:47:41'),
  (10, 'sizova', 'Соня Сизова', 'sonya@answeropedia.org', NULL, 'http://site12.com', '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy', '9447243e3e1706375d22206bf6dd1271', '2016-02-26 16:00:46'),
  (11, 'fox', 'Megan Fox', 'megan@answeropedia.org', NULL, NULL, '$2a$10$89be652869c2c3fd63ff3OML9cDHTjjpFzYSO6rqXf3q5oYRXIYb6', 'db191bbc66746948df5b2f15b6f665ce', '2016-02-12 05:30:48'),
  (12, 'got', 'Vika Got', 'got@answeropedia.org', NULL, NULL, '$2a$10$89be652869c2c3fd63ff3OML9cDHTjjpFzYSO6rqXf3q5oYRXIYb6', 'db191bbc66746948df5b2f15b6f665ce', '2016-02-12 05:30:48'),
  (13, 'donald', 'Donald Trump', 'donald@answeropedia.org', NULL, NULL, '$2a$10$89be652869c2c3fd63ff3OML9cDHTjjpFzYSO6rqXf3q5oYRXIYb6', 'db191bbc66746948df5b2f15b6f665ce', '2016-02-12 05:30:48'),
  (14, 'masha', 'Маша Машина', 'masha@answeropedia.org', NULL, NULL, 'XYjSbuVRiEMhoIWxjWkzcvy', '243e3e1706375d23b06bf6dd1271', '2016-02-26 16:00:46'),
  (15, 'leo', 'Лев Толстой', 'lev@answeropedia.org', NULL, NULL, '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy', '9447243e3e1706375d23bbbbf6dd1271',  '2016-02-26 16:00:46');"
);
