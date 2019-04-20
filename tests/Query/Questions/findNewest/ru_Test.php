<?php

class Query_Questions__findNewest__ru_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test__Ru()
    {
        $questions = (new Questions_Query('ru'))->findNewest();

        $this->assertEquals(10, count($questions));

        $this->assertEquals(33, $questions[0]->id);
        $this->assertEquals('Птицы играют в игры?', $questions[0]->title);
        $this->assertEquals('Нет, не играют.', $questions[0]->answer->text);

        $this->assertEquals(24, $questions[9]->id);
        $this->assertEquals('Расскажете о своем опыте в области управления проектами?', $questions[9]->title);
        $this->assertEquals('Hmm, it`s a long-long story...', $questions[9]->answer->text);
    }

    public function test_firstPage()
    {
        $questions = (new Questions_Query('ru'))->findNewest(1);

        $this->assertEquals(10, count($questions));

        $this->assertEquals(33, $questions[0]->id);
        $this->assertEquals('Птицы играют в игры?', $questions[0]->title);
        $this->assertEquals('Нет, не играют.', $questions[0]->answer->text);

        $this->assertEquals(24, $questions[9]->id);
        $this->assertEquals('Расскажете о своем опыте в области управления проектами?', $questions[9]->title);
        $this->assertEquals('Hmm, it`s a long-long story...', $questions[9]->answer->text);
    }

    public function test_secondPage()
    {
        $questions = (new Questions_Query('ru'))->findNewest(2);

        $this->assertEquals(10, count($questions));

        $this->assertEquals(23, $questions[0]->id);
        $this->assertEquals('Как армия тренирует солдат?', $questions[0]->title);
        $this->assertEquals(null, $questions[0]->answer->text);

        $this->assertEquals(14, $questions[9]->id);
        $this->assertEquals('Как ты?', $questions[9]->title);
        $this->assertEquals('I`m fine, bro!', $questions[9]->answer->text);
    }
}
