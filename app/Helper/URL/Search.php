<?php

namespace Helper\URL;

class Search
{
    public static function get_search_questions_URL(string $lang, string $query = ''): string
    {
        $postfix = $query != '' ? '&q=' . $query : '';

        return SITE_URL . '/' . $lang . '/search?list=questions' . $postfix;
    }

    public static function get_search_categories_URL(string $lang, string $query = ''): string
    {
        $postfix = $query != '' ? '&q=' . $query : '';

        return SITE_URL . '/' . $lang . '/search?list=categories' . $postfix;
    }

    public static function get_search_users_URL(string $lang, string $query = ''): string
    {
        $postfix = $query != '' ? '&q=' . $query : '';

        return SITE_URL . '/' . $lang . '/search?list=users' . $postfix;
    }
}
