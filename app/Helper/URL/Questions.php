<?php

namespace Helper\URL;

class Questions
{
    public static function get_newest_URL(string $lang, int $page = 1): string
    {
        return SITE_URL . '/' . $lang . '/questions/newest' . (($page > 1) ? '?page=' . $page : '');
    }

    public static function get_recently_updated_URL(string $lang, int $page = 1): string
    {
        return SITE_URL . '/' . $lang . '/questions/recently-updated' . (($page > 1) ? '?page=' . $page : '');
    }
}
