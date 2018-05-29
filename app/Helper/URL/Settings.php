<?php

class Settings_URL_Helper
{
    public static function getSettingsURL(string $lang): string
    {
        return SITE_URL.'/'.$lang.'/settings';
    }

    public static function getAvatarURL(string $lang): string
    {
        return SITE_URL.'/'.$lang.'/settings#avatar';
    }

    public static function getSignatureURL(string $lang): string
    {
        return SITE_URL.'/'.$lang.'/settings#signature';
    }

    public static function getRealNameURL(string $lang): string
    {
        return SITE_URL.'/'.$lang.'/settings#real-name';
    }

    public static function getSiteURL(string $lang): string
    {
        return SITE_URL.'/'.$lang.'/settings#site';
    }
}
