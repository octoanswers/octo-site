<?php

namespace Helper\URL;

class Redirect
{
    public static function get_URL(string $lang, \Model\Redirect\Question $redirect): string
    {
        $uri = rtrim($redirect->toTitle, '?');
        $uri = str_replace('_', '__', $uri);
        $uri = str_replace(' ', '_', $uri);

        return SITE_URL . '/' . $lang . '/' . urlencode($uri);
    }

    public static function get_redirect_URL_for_title(string $lang, string $title): string
    {
        $uri = rtrim($title, '?');
        $uri = str_replace('_', '__', $uri);
        $uri = str_replace(' ', '_', $uri);

        return SITE_URL . '/' . $lang . '/' . urlencode($uri);
    }
}
