<?php

namespace Helper\Sort;

class Contributions
{
    public static function sortByContributions(array $contributors): array
    {
        usort($contributors, function (\Model\ContributionToAnswer $a, \Model\ContributionToAnswer $b) {
            return $a->contribution < $b->contribution;
        });

        return $contributors;
    }
}
