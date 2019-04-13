<?php

class Mapper_Question__updateHashtags__ru_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test__Base()
    {
        $question = new Question_Model();
        $question->setID(13);
        $question->setHashtags(['iPhone 8', 'Apple']);

        $question = (new Question_Mapper('ru'))->updateHashtags($question);

        $this->assertEquals(13, $question->getID());
        $this->assertEquals('["iPhone 8","Apple"]', $question->getHashtagsJSON());
        $this->assertEquals(['iPhone 8', 'Apple'], $question->getHashtags());
    }

    public function test__EmptyArray()
    {
        $question = new Question_Model();
        $question->setID(13);
        $question->setHashtags([]);

        $question = (new Question_Mapper('ru'))->updateHashtags($question);

        $this->assertEquals(13, $question->getID());
        $this->assertEquals(null, $question->getHashtagsJSON());
        $this->assertEquals([], $question->getHashtags());
    }

    public function test__HashtagsNotSet()
    {
        $question = new Question_Model();
        $question->setID(13);

        $question = (new Question_Mapper('ru'))->updateHashtags($question);

        $this->assertEquals(13, $question->getID());
        $this->assertEquals(null, $question->getHashtagsJSON());
        $this->assertEquals([], $question->getHashtags());
    }
}
