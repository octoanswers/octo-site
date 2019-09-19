<?php

namespace Humanizer;

/**
 * I need to show a page views value in the format of 1K of equal to one thousand, or 1.1K, 1.2K, 1.9K etc,.
 */
class Contribution
{
    public static function humanize_count(int $count): string
    {
        if ($count < 0) {
            throw new Exception('Count param ' . $count . ' must be greater than or equal to 0', 1);
        }

        if ($count === 0) {
            return '0';
        }

        $formatted = '';

        if ($count >= 1000 && $count < 1000000) {
            if ($count % 1000 === 0) {
                $formatted = ($count / 1000);
            } else {
                $formatted = substr($count, 0, -3) . '.' . substr($count, -3, -2);

                if (substr($formatted, -1, 1) === '0') {
                    $formatted = substr($formatted, 0, -2);
                }
            }

            $formatted .= 'K';
        } else {
            $formatted = $count;
        }

        return $formatted;
    }
}
