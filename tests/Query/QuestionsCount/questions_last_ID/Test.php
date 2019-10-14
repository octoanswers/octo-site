<?php

namespace Test\Query\QuestionsCount\questions_last_ID;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test__Get_questions_last_ID()
    {
        $actualResponse = (new \Query\QuestionsCount('ru'))->questions_last_ID();
        $this->assertEquals(33, $actualResponse);
    }
}
