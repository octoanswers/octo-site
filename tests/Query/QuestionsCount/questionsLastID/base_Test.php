<?php

class Query_Questions_questions_last_ID_base_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test_base()
    {
        $actualResponse = (new QuestionsCount_Query('ru'))->questions_last_ID();
        $this->assertEquals(33, $actualResponse);
    }
}
