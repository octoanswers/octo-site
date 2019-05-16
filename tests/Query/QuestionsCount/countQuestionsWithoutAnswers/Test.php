<?php

class Query_Questions_countQuestionsWithoutAnswers_base_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test_NoParam_ReturnCount()
    {
        $count = (new QuestionsCount_Query('ru'))->countQuestionsWithoutAnswers();
        $this->assertEquals(19, $count);
    }
}
