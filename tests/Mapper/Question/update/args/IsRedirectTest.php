<?php

namespace Test\Mapper\Question\update;

class IsRedirectTest extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test__Update_with_IsRedirect_param()
    {
        $question = new \Model\Question();
        $question->id = 2;
        $question->title = 'This is question?';
        $question->isRedirect = true;

        $question = (new \Mapper\Question('ru'))->update($question);
        $this->assertEquals(2, $question->id);
        $this->assertEquals(true, $question->isRedirect);
    }
}
