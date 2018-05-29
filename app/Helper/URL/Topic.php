<?php

class Topic_URL_Helper extends Abstract_URL_Helper
{
    public static function getURL(string $lang, Topic_Model $topic): string
    {
        return SITE_URL.'/'.$lang.'/topic/'.$topic->getID().'/'.URISlug_Helper::slug($topic->getTitle());
    }

    public static function getURLFromTitle(string $lang, string $topicTitle): string
    {
        return SITE_URL.'/'.$lang.'/topic/'.self::URIFromTitle($topicTitle);
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
