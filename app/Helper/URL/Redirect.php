<?php

class Redirect_URL_Helper extends Abstract_URL_Helper
{
    public static function get_URL(string $lang, Question_Redirect_Model $redirect): string
    {
        return SITE_URL.'/'.$lang.'/'.self::URIFromTitle($redirect->toTitle);
    }

    public static function get_redirect_URL_for_title(string $lang, string $title): string
    {
        return SITE_URL.'/'.$lang.'/'.self::URIFromTitle($title);
    }
}
