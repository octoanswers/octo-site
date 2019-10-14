<?php

namespace Test\Query\Questions\find_newest;

class PerPageTest extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test__Find_first_13_questions()
    {
        $questions = (new \Query\Questions('ru'))->find_newest(1, 13);

        $this->assertEquals(13, count($questions));

        $this->assertEquals(33, $questions[0]->id);
        $this->assertEquals('Птицы играют в игры?', $questions[0]->title);
        $this->assertEquals('Нет, не играют.', $questions[0]->answer->text);

        $this->assertEquals(21, $questions[12]->id);
        $this->assertEquals('Как птицы делают видеоигры?', $questions[12]->title);
        $this->assertEquals('Никто не знает как птицы делают игры.', $questions[12]->answer->text);
    }

    public function test__PerPage_param_equal_zero()
    {
        $this->expectExceptionMessage('Questions list perPage param 0 must be greater than or equal to 5');
        $questions = (new \Query\Questions('ru'))->find_newest(1, 0);
    }

    public function test__PerPage_param_below_zero()
    {
        $this->expectExceptionMessage('Questions list perPage param -1 must be greater than or equal to 5');
        $questions = (new \Query\Questions('ru'))->find_newest(1, -1);
    }

    public function test__PerPage_param_below_min_value()
    {
        $this->expectExceptionMessage('Questions list perPage param 4 must be greater than or equal to 5');
        $questions = (new \Query\Questions('ru'))->find_newest(1, 4);
    }

    public function test__PerPage_param_greater_than_100()
    {
        $this->expectExceptionMessage('Questions list perPage param 101 must be less than or equal to 100');
        $questions = (new \Query\Questions('ru'))->find_newest(1, 101);
    }
}
