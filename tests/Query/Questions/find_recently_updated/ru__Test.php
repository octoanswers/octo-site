<?php

class Query_Questions__find_recently_updated__ruTest extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test__Find_without_params()
    {
        $questions = (new Questions_Query('ru'))->find_recently_updated();

        $this->assertEquals(10, count($questions));

        $this->assertEquals(33, $questions[0]->id);
        $this->assertEquals('Птицы играют в игры?', $questions[0]->title);
        $this->assertEquals('Нет, не играют.', $questions[0]->answer->text);

        $this->assertEquals(20, $questions[1]->id);
        $this->assertEquals('Как разработчики делают интересные игры?', $questions[1]->title);
        $this->assertEquals('#Games', $questions[1]->answer->text);
    }

    public function test__First_page()
    {
        $questions = (new Questions_Query('ru'))->find_recently_updated();

        $this->assertEquals(10, count($questions));

        $this->assertEquals(33, $questions[0]->id);
        $this->assertEquals('Птицы играют в игры?', $questions[0]->title);
        $this->assertEquals('Нет, не играют.', $questions[0]->answer->text);

        $this->assertEquals(20, $questions[1]->id);
        $this->assertEquals('Как разработчики делают интересные игры?', $questions[1]->title);
        $this->assertEquals('#Games', $questions[1]->answer->text);
    }

    public function test__Second_page()
    {
        $questions = (new Questions_Query('ru'))->find_recently_updated(1);

        $this->assertEquals(1, count($questions));

        $this->assertEquals(32, $questions[0]->id);
        $this->assertEquals('Чем отличается проектная деятельность от операционной в области ИТ?', $questions[0]->title);
        $this->assertEquals('There are a lot of differences.', $questions[0]->answer->text);
    }
}
