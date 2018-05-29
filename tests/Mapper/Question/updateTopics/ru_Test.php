<?php

class Mapper_Question__updateTopics__ru_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test__Base()
    {
        $question = new Question_Model();
        $question->setID(13);
        $question->setTopics(['iPhone 8', 'Apple']);

        $question = (new Question_Mapper('ru'))->updateTopics($question);

        $this->assertEquals(13, $question->getID());
        $this->assertEquals('["iPhone 8","Apple"]', $question->getTopicsJSON());
        $this->assertEquals(['iPhone 8', 'Apple'], $question->getTopics());
    }

    public function test__EmptyArray()
    {
        $question = new Question_Model();
        $question->setID(13);
        $question->setTopics([]);

        $question = (new Question_Mapper('ru'))->updateTopics($question);

        $this->assertEquals(13, $question->getID());
        $this->assertEquals(null, $question->getTopicsJSON());
        $this->assertEquals([], $question->getTopics());
    }

    public function test__TopicsNotSet()
    {
        $question = new Question_Model();
        $question->setID(13);

        $question = (new Question_Mapper('ru'))->updateTopics($question);

        $this->assertEquals(13, $question->getID());
        $this->assertEquals(null, $question->getTopicsJSON());
        $this->assertEquals(null, $question->getTopics());
    }
}
