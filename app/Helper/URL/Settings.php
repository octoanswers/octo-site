<?php

class Settings_URL_Helper
{
    public static function get_settings_URL(string $lang): string
    {
        return SITE_URL . '/' . $lang . '/settings';
    }

    public static function get_avatar_URL(string $lang): string
    {
        return SITE_URL . '/' . $lang . '/settings#avatar';
    }

    public static function get_signature_URL(string $lang): string
    {
        return SITE_URL . '/' . $lang . '/settings#signature';
    }

    public static function get_real_name_URL(string $lang): string
    {
        return SITE_URL . '/' . $lang . '/settings#real-name';
    }

    public static function get_site_URL(string $lang): string
    {
        return SITE_URL . '/' . $lang . '/settings#site';
    }
}
