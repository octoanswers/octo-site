<?php

class Redirect_URL_Helper extends Abstract_URL_Helper
{
    public static function getURL(string $lang, Redirect_Model $redirect): string
    {
        return SITE_URL.'/'.$lang.'/'.self::URIFromTitle($redirect->getRedirectTitle());
    }

    public static function getRedirectURLForTitle(string $lang, string $title): string
    {
        return SITE_URL.'/'.$lang.'/'.self::URIFromTitle($title);
    }
}
