<?php

class Questions_URL_Helper extends Abstract_URL_Helper
{
    public static function getNewestURL(string $lang, int $page = 1): string
    {
        return SITE_URL.'/'.$lang.'/questions/newest'.(($page > 1) ? '?page='.$page : '');
    }

    public static function getRecentlyUpdatedURL(string $lang, int $page = 1): string
    {
        return SITE_URL.'/'.$lang.'/questions/recently-updated'.(($page > 1) ? '?page='.$page : '');
    }
}
