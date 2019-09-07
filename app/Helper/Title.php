<?php

class Title_Helper
{
    public static function title_from_question_URI(string $question_URI): string
    {
        $question_URI = str_replace('__', 'DOUBLEUNDERLINE', $question_URI);
        $question_URI = str_replace('_', ' ', $question_URI);
        $question_URI = str_replace('DOUBLEUNDERLINE', '_', $question_URI);

        $question_title = $question_URI . '?';

        return $question_title;
    }
}
