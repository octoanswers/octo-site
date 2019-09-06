<?php

class Query_Questions__find_recently_updated__enTest extends Abstract_DB_TestCase
{
    protected $setUpDB = ['en' => ['questions']];

    public function test__Find_without_params()
    {
        $questions = (new Questions_Query('en'))->find_recently_updated();

        $this->assertEquals(9, count($questions));

        $this->assertEquals(14, $questions[0]->id);
        $this->assertEquals('How are you?', $questions[0]->title);
        $this->assertEquals('I`m fine, bro!', $questions[0]->answer->text);
    }
}
