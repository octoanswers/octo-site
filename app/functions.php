<?php

// Helper Functions 

if (!function_exists('lang')) {
    function lang()
    {
        return $GLOBALS['lang_code'];
    }
}

// Laravel Helpers
// (from https://github.com/laravel/framework/blob/5.8/src/Illuminate/Foundation/helpers.php)

if (!function_exists('trans')) {
    /**
     * Translate the given message.
     *
     * @param  string|null  $key
     * @param  array   $replace
     * @param  string|null  $locale
     * @return \Illuminate\Contracts\Translation\Translator|string|array|null
     */
    function trans($key = null, $replace = [], $locale = null)
    {
        if (is_null($key)) {
            return $GLOBALS['illuminate_translation'];
        }
        return $GLOBALS['illuminate_translation']->trans($key, $replace, $locale);
    }
}

if (!function_exists('trans_choice')) {
    /**
     * Translates the given message based on a count.
     *
     * @param  string  $key
     * @param  int|array|\Countable  $number
     * @param  array   $replace
     * @param  string|null  $locale
     * @return string
     */
    function trans_choice($key, $number, array $replace = [], $locale = null)
    {
        return $GLOBALS['illuminate_translation']->transChoice($key, $number, $replace, $locale);
    }
}

if (!function_exists('__')) {
    /**
     * Translate the given message.
     *
     * @param  string  $key
     * @param  array  $replace
     * @param  string|null  $locale
     * @return string|array|null
     */
    function __($key, $replace = [], $locale = null)
    {
        return $GLOBALS['illuminate_translation']->getFromJson($key, $replace, $locale);
    }
}
