<?php

class Search_URL_Helper
{
    public static function getSearchQuestionsURL(string $lang, string $query = ''): string
    {
        $postfix = $query != '' ? '&q='.$query : '';

        return SITE_URL.'/'.$lang.'/search?list=questions'.$postfix;
    }

    public static function getSearchHashtagsURL(string $lang, string $query = ''): string
    {
        $postfix = $query != '' ? '&q='.$query : '';

        return SITE_URL.'/'.$lang.'/search?list=hashtags'.$postfix;
    }

    public static function getSearchUsersURL(string $lang, string $query = ''): string
    {
        $postfix = $query != '' ? '&q='.$query : '';

        return SITE_URL.'/'.$lang.'/search?list=users'.$postfix;
    }
}
