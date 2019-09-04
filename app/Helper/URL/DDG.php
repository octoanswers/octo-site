<?php

class DDG_URL_Helper
{
    public static function get_search_URL(string $query): string
    {
        return 'https://duckduckgo.com/?q=' . urlencode($query) . '&ia=web';
    }
}
