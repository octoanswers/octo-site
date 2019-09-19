<?php

namespace Helper\URL;

class Sandbox
{
    public static function get_without_answers_URL(string $lang, int $page = 1): string
    {
        return SITE_URL . '/' . $lang . '/sandbox/without-answers' . (($page > 1) ? '?page=' . $page : '');
    }

    public static function get_without_categories_URL(string $lang, int $page = 1): string
    {
        return SITE_URL . '/' . $lang . '/sandbox/without-categories' . (($page > 1) ? '?page=' . $page : '');
    }

    public static function get_all_URL(string $lang, int $page = 1): string
    {
        return SITE_URL . '/' . $lang . '/sandbox/all' . (($page > 1) ? '?page=' . $page : '');
    }
}
