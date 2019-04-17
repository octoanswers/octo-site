<?php

class Query_Questions_findNewestWithAnswer_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions'], 'en' => ['questions']];

    public function test__Ru()
    {
        $questions = (new Questions_Query('ru'))->findNewestWithAnswer();

        $this->assertEquals(10, count($questions));

        $this->assertEquals(33, $questions[0]->getID());
        $this->assertEquals('Птицы играют в игры?', $questions[0]->title);
        $this->assertEquals('Нет, не играют.', $questions[0]->answer->text);

        $this->assertEquals(4, $questions[9]->getID());
        $this->assertEquals('Чем занимается гинеколог?', $questions[9]->title);
        $this->assertEquals('#медицина', $questions[9]->answer->text);
    }

    public function test_firstPage()
    {
        $questions = (new Questions_Query('ru'))->findNewestWithAnswer(1);

        $this->assertEquals(10, count($questions));

        $this->assertEquals(33, $questions[0]->getID());
        $this->assertEquals('Птицы играют в игры?', $questions[0]->title);
        $this->assertEquals('Нет, не играют.', $questions[0]->answer->text);

        $this->assertEquals(4, $questions[9]->getID());
        $this->assertEquals('Чем занимается гинеколог?', $questions[9]->title);
        $this->assertEquals('#медицина', $questions[9]->answer->text);
    }

    public function test_secondPage()
    {
        $questions = (new Questions_Query('ru'))->findNewestWithAnswer(2);

        $this->assertEquals(1, count($questions));
    }
}
