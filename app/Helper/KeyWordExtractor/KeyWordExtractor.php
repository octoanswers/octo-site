<?php

class KeyWordExtractor
{
    public static function extractFromTitle($title)
    {
        $title = mb_strtolower($title);

        // remove question mark
        $string = str_replace('?', '', $title);

        // remove all unused chars
        $string = mb_ereg_replace('[^a-zа-я0-9]', ' ', $string);

        // remove bad words
        $unusedWords = self::loadUnusedWords();
        $clearWords = [];
        foreach (explode(' ', $string) as $word) {
            if (in_array($word, $unusedWords) === false) {
                $clearWords[] = $word;
            }
        }
        $string = implode(' ', $clearWords);

        // trim spaces
        $string = mb_ereg_replace('\s+', ' ', $string);
        $string = trim($string);

        return $string;
    }

    public static function loadUnusedWords()
    {
        $csv = array_map('str_getcsv', file(dirname(__FILE__).'/stop_words_ru.csv'));
        $words = [];
        foreach ($csv as $row) {
            $words[] = $row[0];
        }

        return $words;
    }
}
