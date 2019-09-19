<?php

namespace Helper\URL;

class DDG
{
    public static function get_search_URL(string $query): string
    {
        return 'https://duckduckgo.com/?q=' . urlencode($query) . '&ia=web';
    }
}
