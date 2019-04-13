<?php

class Hashtag_URL_Helper extends Abstract_URL_Helper
{
    public static function getURLFromTitle(string $lang, string $hashtagTitle): string
    {
        return SITE_URL.'/'.$lang.'/hashtag/'.self::URIFromTitle($hashtagTitle);
    }

    // @TODO Deprecated
    public static function titleFromURI(string $uri): string
    {
        $uri = str_replace('__', 'DOUBLEUNDERLINE', $uri);
        $uri = str_replace('_', ' ', $uri);
        $uri = str_replace('DOUBLEUNDERLINE', '_', $uri);

        $title = self::_decodeURI($uri);
        return $title;
    }
}
