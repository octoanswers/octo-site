<?php

class TopicsToQuestions_Relations_Query__findNewestFortopicWithID__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['er_topics_questions']];

    public function test_withoutParams()
    {
        $ERs = (new TopicsToQuestions_Relations_Query('ru'))->findNewestFortopicWithID(58);

        $this->assertEquals(10, count($ERs));

        $this->assertEquals(23, $ERs[0]->getID());
        $this->assertEquals(58, $ERs[0]->getTopicID());
        $this->assertEquals(338, $ERs[0]->getQuestionID());
        //$this->assertEquals('Сколько зарабатывают миллионеры?', $ERs[0]->cachedQuestionTitle);

        $this->assertEquals(13, $ERs[9]->getID());
        $this->assertEquals(58, $ERs[9]->getTopicID());
        $this->assertEquals(335, $ERs[9]->getQuestionID());
        //$this->assertEquals('Исус существовал?', $ERs[9]->cachedQuestionTitle);
    }

    public function test_firstPage()
    {
        $ERs = (new TopicsToQuestions_Relations_Query('ru'))->findNewestFortopicWithID(58, 1);

        $this->assertEquals(10, count($ERs));

        $this->assertEquals(23, $ERs[0]->getID());
        $this->assertEquals(58, $ERs[0]->getTopicID());
        $this->assertEquals(338, $ERs[0]->getQuestionID());
        //$this->assertEquals('Сколько зарабатывают миллионеры?', $ERs[0]->cachedQuestionTitle);

        $this->assertEquals(13, $ERs[9]->getID());
        $this->assertEquals(58, $ERs[9]->getTopicID());
        $this->assertEquals(335, $ERs[9]->getQuestionID());
        //$this->assertEquals('Исус существовал?', $ERs[9]->cachedQuestionTitle);
    }

    public function test_secondPage()
    {
        $ERs = (new TopicsToQuestions_Relations_Query('ru'))->findNewestFortopicWithID(58, 2);

        $this->assertEquals(6, count($ERs));

        $this->assertEquals(12, $ERs[0]->getID());
        $this->assertEquals(58, $ERs[0]->getTopicID());
        $this->assertEquals(33, $ERs[0]->getQuestionID());
        //$this->assertEquals('Зачем нужен футбол?', $ERs[0]->cachedQuestionTitle);

        $this->assertEquals(5, $ERs[5]->getID());
        $this->assertEquals(58, $ERs[5]->getTopicID());
        $this->assertEquals(161, $ERs[5]->getQuestionID());
        //$this->assertEquals('Как насчитывают очки в футболе?', $ERs[5]->cachedQuestionTitle);
    }

    public function test_thirdPage()
    {
        $ERs = (new TopicsToQuestions_Relations_Query('ru'))->findNewestFortopicWithID(58, 3);

        $this->assertEquals(0, count($ERs));
    }
}
