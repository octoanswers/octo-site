<?php

namespace Humanizer;

class DateTime
{
    public static function humanizeTimestamp(string $lang, string $timestamp): string
    {
        $zone = new \DateTimeZone('UTC');
        $humanizer = new \Humanizer\HumanDate\HumanDate($zone, $lang);

        return $humanizer->format($timestamp);
    }
}
