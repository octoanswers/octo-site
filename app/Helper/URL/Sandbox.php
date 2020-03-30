<?php

namespace Helper\URL;

class Sandbox
{
    public static function getWithoutAnswersURL(string $lang, int $page = 1): string
    {
        return SITE_URL.'/'.$lang.'/sandbox/without-answers'.(($page > 1) ? '?page='.$page : '');
    }

    public static function getWithoutCategoriesURL(string $lang, int $page = 1): string
    {
        return SITE_URL.'/'.$lang.'/sandbox/without-categories'.(($page > 1) ? '?page='.$page : '');
    }

    public static function getAllURL(string $lang, int $page = 1): string
    {
        return SITE_URL.'/'.$lang.'/sandbox/all'.(($page > 1) ? '?page='.$page : '');
    }
}
