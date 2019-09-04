<?php

class Query_Questions__find_newest__en__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['en' => ['questions']];

    public function test__En()
    {
        $questions = (new Questions_Query('en'))->find_newest();

        $this->assertEquals(10, count($questions));

        $this->assertEquals(29, $questions[0]->id);
        $this->assertEquals('What is main president daily function?', $questions[0]->title);
        $this->assertEquals('Oh, he make some work.', $questions[0]->answer->text);

        $this->assertEquals(20, $questions[9]->id);
        $this->assertEquals('How developers made interesting games?', $questions[9]->title);
        $this->assertEquals('#Games', $questions[9]->answer->text);
    }
}
