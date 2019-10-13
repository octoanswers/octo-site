<?php

class Query_Search__search_questionsTest extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test__Basic_search()
    {
        $questions = (new \Query\Search('ru'))->search_questions('птицы');

        $this->assertEquals(5, count($questions));

        $questionOne = $questions[0];
        $this->assertEquals(6, $questionOne->id);
        $this->assertEquals('Как птицы помечают свою территорию?', $questionOne->title);

        $questionTwo = $questions[1];
        $this->assertEquals(13, $questionTwo->id);
        $this->assertEquals('Как птицы делают игры?', $questionTwo->title);

        $questionThree = $questions[2];
        $this->assertEquals(16, $questionThree->id);
        $this->assertEquals('Как часто птицы поют песни?', $questionThree->title);

        $questionThree = $questions[4];
        $this->assertEquals(33, $questionThree->id);
        $this->assertEquals('Птицы играют в игры?', $questionThree->title);
    }
}
