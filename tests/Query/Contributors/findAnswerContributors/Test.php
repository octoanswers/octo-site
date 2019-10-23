<?php

namespace Test\Query\Contributors\findAnswerContributors;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = [
        'ru' => ['revisions', 'questions'],
        'users' => ['users']
    ];

    public function test__Contributors_exists()
    {
        $contributors = (new \Query\Contributors('ru'))->findAnswerContributors(4);

        $first_contributor = $contributors[0];

        $this->assertEquals(4, $first_contributor->id);
        $this->assertEquals('Известный писатель', $first_contributor->signature);

        $this->assertEquals(138, $first_contributor->contributionToAnswer->contribution);
        $this->assertEquals(136, $first_contributor->contributionToAnswer->insertionsCount);
        $this->assertEquals(2, $first_contributor->contributionToAnswer->deletionsCount);

        $second_contributor = $contributors[1];

        $this->assertEquals(6, $second_contributor->id);
        $this->assertEquals(null, $second_contributor->signature);

        $this->assertEquals(103, $second_contributor->contributionToAnswer->contribution);
        $this->assertEquals(68, $second_contributor->contributionToAnswer->insertionsCount);
        $this->assertEquals(35, $second_contributor->contributionToAnswer->deletionsCount);

        $this->assertEquals(3, count($contributors));
    }

    public function test__Contributors_not_exists()
    {
        $contributors = (new \Query\Contributors('ru'))->findAnswerContributors(28);

        $this->assertEquals(0, count($contributors));
    }
}
