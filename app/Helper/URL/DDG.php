<?php

namespace Helper\URL;

class DDG
{
    public static function getSearchURL(string $query): string
    {
        return 'https://duckduckgo.com/?q='.urlencode($query).'&ia=web';
    }
}
