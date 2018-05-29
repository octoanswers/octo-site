<?php

class Sandbox_URL_Helper extends Abstract_URL_Helper
{
    public static function getWithoutAnswersURL(string $lang, int $page = 1): string
    {
        return SITE_URL.'/'.$lang.'/sandbox/without-answers'.(($page > 1) ? '?page='.$page : '');
    }

    public static function getWithoutTopicsURL(string $lang, int $page = 1): string
    {
        return SITE_URL.'/'.$lang.'/sandbox/without-topics'.(($page > 1) ? '?page='.$page : '');
    }

    public static function getAllURL(string $lang, int $page = 1): string
    {
        return SITE_URL.'/'.$lang.'/sandbox/all'.(($page > 1) ? '?page='.$page : '');
    }
}
