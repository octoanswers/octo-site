<?php

class Query_Questions_find_newest_perPage_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test_FindFirst13Questions_Ok()
    {
        $questions = (new Questions_Query('ru'))->find_newest(1, 13);

        $this->assertEquals(13, count($questions));

        $this->assertEquals(33, $questions[0]->id);
        $this->assertEquals('Птицы играют в игры?', $questions[0]->title);
        $this->assertEquals('Нет, не играют.', $questions[0]->answer->text);

        $this->assertEquals(21, $questions[12]->id);
        $this->assertEquals('Как птицы делают видеоигры?', $questions[12]->title);
        $this->assertEquals('Никто не знает как птицы делают игры.', $questions[12]->answer->text);
    }
}
