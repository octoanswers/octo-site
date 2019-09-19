<?php

namespace Humanizer;

class DateTime
{
    public static function humanize_timestamp(string $lang, string $timestamp): string
    {
        $zone = new \DateTimeZone('UTC');
        $humanizer = new \Humanizer\HumanDate\HumanDate($zone, $lang);

        return $humanizer->format($timestamp);
    }
}
