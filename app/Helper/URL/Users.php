<?php

class Users_URL_Helper
{
    public static function get_newest_URL(string $lang, int $page = 1): string
    {
        return SITE_URL . '/' . $lang . '/users/newest' . (($page > 1) ? '?page=' . $page : '');
    }
}
