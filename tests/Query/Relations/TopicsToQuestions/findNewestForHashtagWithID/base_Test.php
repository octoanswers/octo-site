<?php

class CategoriesToQuestions_Relations_Query__findNewestForcategoryWithID__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['er_categories_questions']];

    public function test_withoutParams()
    {
        $ERs = (new CategoriesToQuestions_Relations_Query('ru'))->findNewestForcategoryWithID(58);

        $this->assertEquals(10, count($ERs));

        $this->assertEquals(23, $ERs[0]->id);
        $this->assertEquals(58, $ERs[0]->categoryID);
        $this->assertEquals(338, $ERs[0]->questionID);
        //$this->assertEquals('Сколько зарабатывают миллионеры?', $ERs[0]->cachedQuestionTitle);

        $this->assertEquals(13, $ERs[9]->id);
        $this->assertEquals(58, $ERs[9]->categoryID);
        $this->assertEquals(335, $ERs[9]->questionID);
        //$this->assertEquals('Исус существовал?', $ERs[9]->cachedQuestionTitle);
    }

    public function test_firstPage()
    {
        $ERs = (new CategoriesToQuestions_Relations_Query('ru'))->findNewestForcategoryWithID(58, 1);

        $this->assertEquals(10, count($ERs));

        $this->assertEquals(23, $ERs[0]->id);
        $this->assertEquals(58, $ERs[0]->categoryID);
        $this->assertEquals(338, $ERs[0]->questionID);
        //$this->assertEquals('Сколько зарабатывают миллионеры?', $ERs[0]->cachedQuestionTitle);

        $this->assertEquals(13, $ERs[9]->id);
        $this->assertEquals(58, $ERs[9]->categoryID);
        $this->assertEquals(335, $ERs[9]->questionID);
        //$this->assertEquals('Исус существовал?', $ERs[9]->cachedQuestionTitle);
    }

    public function test_secondPage()
    {
        $ERs = (new CategoriesToQuestions_Relations_Query('ru'))->findNewestForcategoryWithID(58, 2);

        $this->assertEquals(6, count($ERs));

        $this->assertEquals(12, $ERs[0]->id);
        $this->assertEquals(58, $ERs[0]->categoryID);
        $this->assertEquals(33, $ERs[0]->questionID);
        //$this->assertEquals('Зачем нужен футбол?', $ERs[0]->cachedQuestionTitle);

        $this->assertEquals(5, $ERs[5]->id);
        $this->assertEquals(58, $ERs[5]->categoryID);
        $this->assertEquals(161, $ERs[5]->questionID);
        //$this->assertEquals('Как насчитывают очки в футболе?', $ERs[5]->cachedQuestionTitle);
    }

    public function test_thirdPage()
    {
        $ERs = (new CategoriesToQuestions_Relations_Query('ru'))->findNewestForcategoryWithID(58, 3);

        $this->assertEquals(0, count($ERs));
    }
}
