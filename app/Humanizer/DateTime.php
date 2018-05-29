<?php

class DateTime_Humanizer
{
    public static function humanizeTimestamp(string $lang, string $timestamp): string
    {
        $zone = new DateTimeZone('UTC');
        $humanizer = new HumanDate($zone, $lang);

        return $humanizer->format($timestamp);
    }
}
