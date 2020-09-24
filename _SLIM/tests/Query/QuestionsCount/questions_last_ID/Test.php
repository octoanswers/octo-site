<?php

namespace Test\Query\QuestionsCount\questionsLastID;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test__Get_questionsLastID()
    {
        $actualResponse = (new \Query\QuestionsCount('ru'))->questionsLastID();
        $this->assertEquals(33, $actualResponse);
    }
}
