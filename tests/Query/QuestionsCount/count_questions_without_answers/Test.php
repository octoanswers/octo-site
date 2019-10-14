<?php

namespace Test\Query\QuestionsCount\count_questions_without_answers;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test__Count_without_params()
    {
        $count = (new \Query\QuestionsCount('ru'))->count_questions_without_answers();
        $this->assertEquals(19, $count);
    }
}
