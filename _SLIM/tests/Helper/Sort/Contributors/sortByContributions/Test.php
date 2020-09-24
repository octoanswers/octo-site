<?php

namespace Test\Helper\Sort\Contributors\sortByContributions;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test__Revisions_exists()
    {
        $contribution_one = new \Model\ContributionToAnswer();
        $contribution_one->userID = 7;
        $contribution_one->contribution = 6;

        $contribution_two = new \Model\ContributionToAnswer();
        $contribution_two->userID = 13;
        $contribution_two->contribution = 75;

        $contribution_three = new \Model\ContributionToAnswer();
        $contribution_three->userID = 2;
        $contribution_three->contribution = 19;

        $contributions = [$contribution_one, $contribution_two, $contribution_three];

        $contributions = \Helper\Sort\Contributions::sortByContributions($contributions);

        $this->assertEquals(13, $contributions[0]->userID);
        $this->assertEquals(2, $contributions[1]->userID);
        $this->assertEquals(7, $contributions[2]->userID);
    }

    public function test__Empty_args()
    {
        $contributors = \Helper\Sort\Contributions::sortByContributions([]);

        $this->assertEquals(0, count($contributors));
    }
}
