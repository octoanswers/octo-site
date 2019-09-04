<?php

class Contributors_Sort_Helper
{
    public static function sort_by_contributions(array $contributors): array
    {
        usort($contributors, function ($a, $b) {
            return $a['contribution'] < $b['contribution'];
        });

        return $contributors;
    }
}
