<?php

class Hashtag_URL_Helper extends Abstract_URL_Helper
{
    public static function getURLFromTitle(string $lang, string $hashtagTitle): string
    {
        return SITE_URL.'/'.$lang.'/tag/'.urlencode($hashtagTitle);
    }
}
