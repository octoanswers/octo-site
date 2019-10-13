<?php

class Mapper_Question__create__isRedirect__Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test_CreateWithIsRedirectParam_Ok()
    {
        $question = new \Model\Question();
        $question->title = 'This is question?';
        $question->isRedirect = true;

        $question = (new \Mapper\Question('ru'))->create($question);
        $this->assertEquals(34, $question->id);
        $this->assertEquals(true, $question->isRedirect);
    }
}
