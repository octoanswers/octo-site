<?php

class Query_Questions__findQuestionsWithImage__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test__Ru()
    {
        $questions = (new Questions_Query('ru'))->findQuestionsWithImage(32);

        $this->assertEquals(3, count($questions));

        $this->assertEquals(29, $questions[0]->id);
        $this->assertEquals('Чем президенты занимаются в выходные?', $questions[0]->title);
        $this->assertEquals('1_000_1', $questions[0]->imageBaseName);

        $this->assertEquals(25, $questions[1]->id);
        $this->assertEquals('Какова цена iPhone 6?', $questions[1]->title);
        $this->assertEquals('1_000_2', $questions[1]->imageBaseName);

        $this->assertEquals(14, $questions[2]->id);
        $this->assertEquals('Как ты?', $questions[2]->title);
        $this->assertEquals('1_000_3', $questions[2]->imageBaseName);
    }

    public function test_firstPage()
    {
        $questions = (new Questions_Query('ru'))->findQuestionsWithImage(27);

        $this->assertEquals(3, count($questions));

        $this->assertEquals(25, $questions[0]->id);
        $this->assertEquals('Какова цена iPhone 6?', $questions[0]->title);
        $this->assertEquals('1_000_2', $questions[0]->imageBaseName);

        $this->assertEquals(14, $questions[1]->id);
        $this->assertEquals('Как ты?', $questions[1]->title);
        $this->assertEquals('1_000_3', $questions[1]->imageBaseName);

        $this->assertEquals(9, $questions[2]->id);
        $this->assertEquals('Где получить ответ на вопрос?', $questions[2]->title);
        $this->assertEquals('1_000_4', $questions[2]->imageBaseName);
    }

    public function test_secondPage()
    {
        $questions = (new Questions_Query('ru'))->findQuestionsWithImage(2);

        $this->assertEquals(0, count($questions));
    }
}
