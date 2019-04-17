<?php

class HashtagsToQuestions_Relations_Query__findNewestForhashtagWithID__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['er_hashtags_questions']];

    public function test_withoutParams()
    {
        $ERs = (new HashtagsToQuestions_Relations_Query('ru'))->findNewestForhashtagWithID(58);

        $this->assertEquals(10, count($ERs));

        $this->assertEquals(23, $ERs[0]->getID());
        $this->assertEquals(58, $ERs[0]->getHashtagID());
        $this->assertEquals(338, $ERs[0]->questionID);
        //$this->assertEquals('Сколько зарабатывают миллионеры?', $ERs[0]->cachedQuestionTitle);

        $this->assertEquals(13, $ERs[9]->getID());
        $this->assertEquals(58, $ERs[9]->getHashtagID());
        $this->assertEquals(335, $ERs[9]->questionID);
        //$this->assertEquals('Исус существовал?', $ERs[9]->cachedQuestionTitle);
    }

    public function test_firstPage()
    {
        $ERs = (new HashtagsToQuestions_Relations_Query('ru'))->findNewestForhashtagWithID(58, 1);

        $this->assertEquals(10, count($ERs));

        $this->assertEquals(23, $ERs[0]->getID());
        $this->assertEquals(58, $ERs[0]->getHashtagID());
        $this->assertEquals(338, $ERs[0]->questionID);
        //$this->assertEquals('Сколько зарабатывают миллионеры?', $ERs[0]->cachedQuestionTitle);

        $this->assertEquals(13, $ERs[9]->getID());
        $this->assertEquals(58, $ERs[9]->getHashtagID());
        $this->assertEquals(335, $ERs[9]->questionID);
        //$this->assertEquals('Исус существовал?', $ERs[9]->cachedQuestionTitle);
    }

    public function test_secondPage()
    {
        $ERs = (new HashtagsToQuestions_Relations_Query('ru'))->findNewestForhashtagWithID(58, 2);

        $this->assertEquals(6, count($ERs));

        $this->assertEquals(12, $ERs[0]->getID());
        $this->assertEquals(58, $ERs[0]->getHashtagID());
        $this->assertEquals(33, $ERs[0]->questionID);
        //$this->assertEquals('Зачем нужен футбол?', $ERs[0]->cachedQuestionTitle);

        $this->assertEquals(5, $ERs[5]->getID());
        $this->assertEquals(58, $ERs[5]->getHashtagID());
        $this->assertEquals(161, $ERs[5]->questionID);
        //$this->assertEquals('Как насчитывают очки в футболе?', $ERs[5]->cachedQuestionTitle);
    }

    public function test_thirdPage()
    {
        $ERs = (new HashtagsToQuestions_Relations_Query('ru'))->findNewestForhashtagWithID(58, 3);

        $this->assertEquals(0, count($ERs));
    }
}
