<?php

class DDG_URL_Helper
{
    public static function getSearchURL(string $query): string
    {
        return 'https://duckduckgo.com/?q='.urlencode($query).'&ia=web';
    }
}
