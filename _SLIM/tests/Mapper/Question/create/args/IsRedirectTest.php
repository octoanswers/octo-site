<?php

namespace Test\Mapper\Question\create;

class IsRedirectTest extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test__Create_with_IsRedirect_param()
    {
        $question = new \Model\Question();
        $question->title = 'This is question?';
        $question->isRedirect = true;

        $question = (new \Mapper\Question('ru'))->create($question);
        $this->assertEquals(34, $question->id);
        $this->assertEquals(true, $question->isRedirect);
    }
}
