<?php

class Categories_URL_Helper extends Abstract_URL_Helper
{
    public static function getNewestURL(string $lang, int $page = 1): string
    {
        return SITE_URL . '/' . $lang . '/categories/newest' . (($page > 1) ? '?page=' . $page : '');
    }
}
