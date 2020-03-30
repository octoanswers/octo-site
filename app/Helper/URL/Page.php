<?php

namespace Helper\URL;

class Page
{
    public static function getMainURL(string $lang): string
    {
        return SITE_URL.'/'.$lang;
    }

    public static function getFeedURL(string $lang): string
    {
        return SITE_URL.'/'.$lang.'/feed';
    }

    public static function getFlowURL(string $lang): string
    {
        return SITE_URL.'/'.$lang.'/flow';
    }

    public static function getAskURL(string $lang): string
    {
        return SITE_URL.'/'.$lang.'/ask';
    }
}
