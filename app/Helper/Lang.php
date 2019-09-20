<?php

namespace Helper;

/**
 * Determine language for UI.
 *
 * We have 3 simple, prioritized options:
 *
 * 1. If GET-param is set, use it;
 * 2. If $_COOKIE['lang'] is set, use it;
 * 3. If $_SERVER['HTTP_ACCEPT_LANGUAGE'] is set, use it;
 * 4. Use default language (en);
 */
class Lang
{
    public static function get_supported_langs(): array
    {
        return ['en', 'ru'];
    }

    public static function get_default_lang(): string
    {
        return 'en';
    }

    public static function get()
    {
        return self::detect($_GET, $_COOKIE, $_SERVER);
    }

    public static function detect($get, $cookie, $server)
    {
        $supported_languages = ['en', 'ru'];
        $default_language = 'en';

        // 1. If language GET-param is set, use it;
        if (isset($get['l'])) {
            $lang = $get['l'];
            if (!in_array($lang, $supported_languages)) {
                $lang = $default_language;
            }

            $cookieStorage = new \Helper\CookieStorage();
            $cookieStorage->set_lang($lang);

            return $lang;
        }

        // 2. If $_COOKIE['lang'] is set, use it;
        if (isset($cookie['lang'])) {
            $lang = $cookie['lang'];
            if (!in_array($lang, $supported_languages)) {
                $lang = $default_language;
            }

            return $lang;
        }

        // 3. If $_SERVER['HTTP_ACCEPT_LANGUAGE'] is set, use it;
        if (isset($server['HTTP_ACCEPT_LANGUAGE'])) {
            $lang = substr($server['HTTP_ACCEPT_LANGUAGE'], 0, 2);
            if (!in_array($lang, $supported_languages)) {
                $lang = $default_language;
            }

            $cookieStorage = new \Helper\CookieStorage();
            $cookieStorage->set_lang($lang);

            return $lang;
        }

        // 4. Use default language (en);
        return $default_language;
    }
}
