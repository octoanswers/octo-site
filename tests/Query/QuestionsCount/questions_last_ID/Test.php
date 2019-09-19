<?php

class Query_QuestionsCount__questions_last_IDTest extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test__Get_questions_last_ID()
    {
        $actualResponse = (new \Query\QuestionsCount('ru'))->questions_last_ID();
        $this->assertEquals(33, $actualResponse);
    }
}
