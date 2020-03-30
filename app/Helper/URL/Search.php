<?php

namespace Helper\URL;

class Search
{
    public static function getSearchQuestionsURL(string $lang, string $query = ''): string
    {
        $postfix = $query != '' ? '&q='.$query : '';

        return SITE_URL.'/'.$lang.'/search?list=questions'.$postfix;
    }

    public static function getSearchCategoriesURL(string $lang, string $query = ''): string
    {
        $postfix = $query != '' ? '&q='.$query : '';

        return SITE_URL.'/'.$lang.'/search?list=categories'.$postfix;
    }

    public static function getSearchUsersURL(string $lang, string $query = ''): string
    {
        $postfix = $query != '' ? '&q='.$query : '';

        return SITE_URL.'/'.$lang.'/search?list=users'.$postfix;
    }
}
