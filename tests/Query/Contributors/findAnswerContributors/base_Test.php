<?php

class Query_Contributions__findAnswerContributors__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['revisions', 'questions'], 'users' => ['users']];

    public function testRevisionExists()
    {
        $contributors = (new Contributors_Query('ru'))->findAnswerContributors(4);

        $this->assertEquals(4, $contributors[0]->getID());
        $this->assertEquals('Известный писатель', $contributors[0]->signature);
        $this->assertEquals(138, $contributors[0]->contribution);
        $this->assertEquals(136, $contributors[0]->insertionsCount);
        $this->assertEquals(2, $contributors[0]->deletionsCount);

        $this->assertEquals(6, $contributors[1]->getID());
        $this->assertEquals(null, $contributors[1]->signature);
        $this->assertEquals(103, $contributors[1]->contribution);
        $this->assertEquals(68, $contributors[1]->insertionsCount);
        $this->assertEquals(35, $contributors[1]->deletionsCount);

        $this->assertEquals(3, count($contributors));
    }

    public function testRevisionNotExists()
    {
        $contributors = (new Contributors_Query('ru'))->findAnswerContributors(28);

        $this->assertEquals(0, count($contributors));
    }
}
