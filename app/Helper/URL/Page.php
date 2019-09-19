<?php

namespace Helper\URL;

class Page
{
    public static function get_main_URL(string $lang): string
    {
        return SITE_URL . '/' . $lang;
    }

    public static function get_feed_URL(string $lang): string
    {
        return SITE_URL . '/' . $lang . '/feed';
    }

    public static function get_flow_URL(string $lang): string
    {
        return SITE_URL . '/' . $lang . '/flow';
    }
}
