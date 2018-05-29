<?php

class Page_URL_Helper
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
}
