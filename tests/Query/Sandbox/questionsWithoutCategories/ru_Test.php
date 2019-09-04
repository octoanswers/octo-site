<?php

class Sandbox_Query__questions_without_categories__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions'], 'en' => ['questions']];

    public function test_Ru()
    {
        $questions = (new Sandbox_Query('ru'))->questions_without_categories();

        $this->assertEquals(10, count($questions));

        $this->assertEquals(33, $questions[0]->id);
        $this->assertEquals('Птицы играют в игры?', $questions[0]->title);

        $this->assertEquals(8, $questions[9]->id);
        $this->assertEquals('Как дела?', $questions[9]->title);
    }

    public function test_firstPage()
    {
        $questions = (new Sandbox_Query('ru'))->questions_without_categories(1);

        $this->assertEquals(10, count($questions));

        $this->assertEquals(33, $questions[0]->id);
        $this->assertEquals('Птицы играют в игры?', $questions[0]->title);

        $this->assertEquals(8, $questions[9]->id);
        $this->assertEquals('Как дела?', $questions[9]->title);
    }

    public function test_secondPage()
    {
        $questions = (new Sandbox_Query('ru'))->questions_without_categories(2);

        $this->assertEquals(10, count($questions));

        $this->assertEquals(9, $questions[0]->id);
        $this->assertEquals(19, $questions[9]->id);
    }
}
