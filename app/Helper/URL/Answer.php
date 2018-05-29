<?php

class Answer_URL_Helper extends Abstract_URL_Helper
{
    public static function getHistoryURL(string $lang, Question_Model $question): string
    {
        return SITE_URL.'/'.$lang.'/answer/'.$question->getID().'/history';
    }

    public static function getEditURL(string $lang, Question_Model $question): string
    {
        return SITE_URL.'/'.$lang.'/answer/'.$question->getID().'/edit';
    }
}
