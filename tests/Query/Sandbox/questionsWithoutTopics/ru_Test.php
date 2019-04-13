<?php

class Sandbox_Query__questionsWithoutHashtags__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions'], 'en' => ['questions']];

    public function test_Ru()
    {
        $questions = (new Sandbox_Query('ru'))->questionsWithoutHashtags();

        $this->assertEquals(10, count($questions));

        $this->assertEquals(33, $questions[0]->getID());
        $this->assertEquals('Птицы играют в игры?', $questions[0]->getTitle());

        $this->assertEquals(10, $questions[9]->getID());
        $this->assertEquals('Как отрастить бороду?', $questions[9]->getTitle());
    }

    public function test_firstPage()
    {
        $questions = (new Sandbox_Query('ru'))->questionsWithoutHashtags(1);

        $this->assertEquals(10, count($questions));

        $this->assertEquals(33, $questions[0]->getID());
        $this->assertEquals('Птицы играют в игры?', $questions[0]->getTitle());

        $this->assertEquals(10, $questions[9]->getID());
        $this->assertEquals('Как отрастить бороду?', $questions[9]->getTitle());
    }

    public function test_secondPage()
    {
        $questions = (new Sandbox_Query('ru'))->questionsWithoutHashtags(2);

        $this->assertEquals(10, count($questions));

        $this->assertEquals(12, $questions[0]->getID());
        $this->assertEquals(22, $questions[9]->getID());
    }
}
