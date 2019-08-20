<?php

class Query_Questions_questionsLastID_base_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test_base()
    {
        $actualResponse = (new QuestionsCount_Query('ru'))->questionsLastID();
        $this->assertEquals(33, $actualResponse);
    }
}
