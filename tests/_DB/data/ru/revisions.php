<?php

$pdo->query(
    "INSERT INTO revisions (rev_id, rev_answer_id, rev_opcodes, rev_base_text, rev_comment, rev_parent_id, rev_user_id, rev_created_at) VALUES
        (1, 13, 'xxx', 'Answer text.', 'Rev comment', NULL, 4, '2016-05-06 09:47:51'),
        (2,  4, 'c000d2i136', 'Answer text.', 'Rev comment',  NULL, 4, '2017-06-07 09:48:24'),
        (3,  4, 'c000d24i66', 'Answer text.', 'Rev comment 2',  2, 7, '2015-12-16 13:28:56'),
        (4,  4, 'c000d35i68', 'Last answer for question 4.', 'Some rev comment',  3, 6, '2016-05-06 09:48:24'),
        (5,  8, 'xxx', 'Answer text.', 'Rev comment',  NULL, 4, '2015-12-16 13:28:56'),
        (6,  8, 'xxx', 'Answer text.', 'Rev comment',  5, 4, '2015-12-16 13:28:56'),
        (7,  3, 'xxx', 'Answer text.', 'Rev comment',  7, 4, '2015-12-16 13:28:56');"
);
