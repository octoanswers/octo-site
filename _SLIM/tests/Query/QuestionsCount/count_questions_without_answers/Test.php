<?php

namespace Test\Query\QuestionsCount\countQuestionsWithoutAnswers;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test__Count_without_params()
    {
        $count = (new \Query\QuestionsCount('ru'))->countQuestionsWithoutAnswers();
        $this->assertEquals(19, $count);
    }
}
