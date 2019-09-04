<?php

class Query_Questions_count_questions_without_answers_base_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test_NoParam_ReturnCount()
    {
        $count = (new QuestionsCount_Query('ru'))->count_questions_without_answers();
        $this->assertEquals(19, $count);
    }
}
