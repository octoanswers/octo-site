<?php

class Query_QuestionsCount__count_questions_without_answersTest extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test__Count_without_params()
    {
        $count = (new \Query\QuestionsCount('ru'))->count_questions_without_answers();
        $this->assertEquals(19, $count);
    }
}
