<?php

class Query_Questions_findNewest_perPage_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test_FindFirst13Questions_Ok()
    {
        $questions = (new Questions_Query('ru'))->findNewest(1, 13);

        $this->assertEquals(13, count($questions));

        $this->assertEquals(33, $questions[0]->getID());
        $this->assertEquals('Птицы играют в игры?', $questions[0]->getTitle());
        $this->assertEquals('Нет, не играют.', $questions[0]->answer->text);

        $this->assertEquals(21, $questions[12]->getID());
        $this->assertEquals('Как птицы делают видеоигры?', $questions[12]->getTitle());
        $this->assertEquals('Никто не знает как птицы делают игры.', $questions[12]->answer->text);
    }
}
