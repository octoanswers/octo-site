<?php

namespace Helper\URL;

class Categories
{
    public static function get_newest_URL(string $lang, int $page = 1): string
    {
        return SITE_URL . '/' . $lang . '/categories/newest' . (($page > 1) ? '?page=' . $page : '');
    }
}
