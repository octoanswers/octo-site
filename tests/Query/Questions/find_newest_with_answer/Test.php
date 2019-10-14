<?php

namespace Test\Query\Questions\find_newest_with_answer;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['questions'], 'en' => ['questions']];

    public function test__Find_without_params()
    {
        $questions = (new \Query\Questions('ru'))->find_newest_with_answer();

        $this->assertEquals(10, count($questions));

        $this->assertEquals(33, $questions[0]->id);
        $this->assertEquals('Птицы играют в игры?', $questions[0]->title);
        $this->assertEquals('Нет, не играют.', $questions[0]->answer->text);

        $this->assertEquals(4, $questions[9]->id);
        $this->assertEquals('Чем занимается гинеколог?', $questions[9]->title);
        $this->assertEquals('#медицина', $questions[9]->answer->text);
    }

    public function test__First_page()
    {
        $questions = (new \Query\Questions('ru'))->find_newest_with_answer(1);

        $this->assertEquals(10, count($questions));

        $this->assertEquals(33, $questions[0]->id);
        $this->assertEquals('Птицы играют в игры?', $questions[0]->title);
        $this->assertEquals('Нет, не играют.', $questions[0]->answer->text);

        $this->assertEquals(4, $questions[9]->id);
        $this->assertEquals('Чем занимается гинеколог?', $questions[9]->title);
        $this->assertEquals('#медицина', $questions[9]->answer->text);
    }

    public function test__Second_page()
    {
        $questions = (new \Query\Questions('ru'))->find_newest_with_answer(2);

        $this->assertEquals(1, count($questions));
    }
}
