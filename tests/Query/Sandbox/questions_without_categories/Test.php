<?php

namespace Test\Query\Sandbox\questionsWithoutCategories;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['questions'], 'en' => ['questions']];

    public function test__Without_params()
    {
        $questions = (new \Query\Sandbox('ru'))->questionsWithoutCategories();

        $this->assertEquals(10, count($questions));

        $this->assertEquals(33, $questions[0]->id);
        $this->assertEquals('Птицы играют в игры?', $questions[0]->title);

        $this->assertEquals(8, $questions[9]->id);
        $this->assertEquals('Как дела?', $questions[9]->title);
    }

    public function test__First_page()
    {
        $questions = (new \Query\Sandbox('ru'))->questionsWithoutCategories(1);

        $this->assertEquals(10, count($questions));

        $this->assertEquals(33, $questions[0]->id);
        $this->assertEquals('Птицы играют в игры?', $questions[0]->title);

        $this->assertEquals(8, $questions[9]->id);
        $this->assertEquals('Как дела?', $questions[9]->title);
    }

    public function test__Second_page()
    {
        $questions = (new \Query\Sandbox('ru'))->questionsWithoutCategories(2);

        $this->assertEquals(10, count($questions));

        $this->assertEquals(9, $questions[0]->id);
        $this->assertEquals(19, $questions[9]->id);
    }
}
