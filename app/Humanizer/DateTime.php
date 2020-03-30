<?php

namespace Humanizer;

use DateTimeZone;
use Humanizer\HumanDate\HumanDate;

class DateTime
{
    public static function humanizeTimestamp(string $lang, string $timestamp): string
    {
        $zone = new DateTimeZone('UTC');
        $humanizer = new HumanDate($zone, $lang);

        return $humanizer->format($timestamp);
    }
}
