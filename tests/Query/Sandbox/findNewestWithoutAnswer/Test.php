<?php

class Sandbox_Query__find_newest_without_answer_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions'], 'en' => ['questions']];

    public function test_Ru()
    {
        $questions = (new Sandbox_Query('ru'))->find_newest_without_answer();

        $this->assertEquals(10, count($questions));

        $this->assertEquals(31, $questions[0]->id);
        $this->assertEquals('Какая сейчас погода?', $questions[0]->title);
        $this->assertEquals(null, $questions[0]->answer->text);

        $this->assertEquals(19, $questions[9]->id);
        $this->assertEquals('Огонь уничтожает ДНК?', $questions[9]->title);
        $this->assertEquals(null, $questions[9]->answer->text);
    }

    public function test_firstPage()
    {
        $questions = (new Sandbox_Query('ru'))->find_newest_without_answer(1);

        $this->assertEquals(10, count($questions));

        $this->assertEquals(31, $questions[0]->id);
        $this->assertEquals('Какая сейчас погода?', $questions[0]->title);
        $this->assertEquals(null, $questions[0]->answer->text);

        $this->assertEquals(19, $questions[9]->id);
        $this->assertEquals('Огонь уничтожает ДНК?', $questions[9]->title);
        $this->assertEquals(null, $questions[9]->answer->text);
    }

    public function test_secondPage()
    {
        $questions = (new Sandbox_Query('ru'))->find_newest_without_answer(2);

        $this->assertEquals(10, count($questions));

        $this->assertEquals(18, $questions[0]->id);
        $this->assertEquals(3, $questions[9]->id);
    }
}
