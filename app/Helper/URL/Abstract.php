<?php

// @TODO Deprecated
class Abstract_URL_Helper
{
    public static function titleFromURI(string $uri): string
    {
        $uri = str_replace('__', 'DOUBLEUNDERLINE', $uri);
        $uri = str_replace('_', ' ', $uri);
        $uri = str_replace('DOUBLEUNDERLINE', '_', $uri);

        $uri = $uri.'?';

        $title = self::_decodeURI($uri);
        return $title;
    }

    public static function URIFromTitle(string $title): string
    {
        $uri = str_replace('_', 'DOUBLEUNDERLINE', $title);
        $uri = str_replace(' ', '_', $uri);
        $uri = str_replace('DOUBLEUNDERLINE', '__', $uri);

        $uri = trim($uri, '?');

        return self::_encodeURI($uri);
    }

    protected static $entities = ['%', '"', '&', "'", '+', '=', '?', '\\', '^', '`', '~'];
    protected static $replacements = ['%25', '%22', '%26', '%27', '%2B', '%3D', '%3F', '%5C', '%5E', '%60', '%7E'];

    protected static function _encodeURI($string)
    {
        return str_replace(self::$entities, self::$replacements, $string);
    }

    protected static function _decodeURI($string)
    {
        return str_replace(self::$replacements, self::$entities, $string);
    }
}
