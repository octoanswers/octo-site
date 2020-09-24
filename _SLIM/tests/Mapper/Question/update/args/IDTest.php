<?php

namespace Test\Mapper\Question\update;

class IDTest extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test__Update_with_not_exists_ID()
    {
        $question = new \Model\Question();
        $question->id = 2215;
        $question->title = 'This is question?';
        $question->isRedirect = false;

        $this->expectExceptionMessage('Question with ID 2215 not exists');
        $question = (new \Mapper\Question('ru'))->update($question);
    }

    public function test__Update_with_ID_equal_zero()
    {
        $question = new \Model\Question();
        $question->id = 0;
        $question->title = 'This is question?';
        $question->isRedirect = false;

        $this->expectExceptionMessage('Question id param 0 must be greater than or equal to 1');
        $question = (new \Mapper\Question('ru'))->update($question);
    }

    public function test__Update_with_ID_below_zero()
    {
        $question = new \Model\Question();
        $question->id = -1;
        $question->title = 'This is question?';
        $question->isRedirect = true;

        $this->expectExceptionMessage('Question id param -1 must be greater than or equal to 1');
        $question = (new \Mapper\Question('ru'))->update($question);
    }
}
