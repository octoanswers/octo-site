<?php

class Mapper_Question__updateHashtags__ru_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test__Base()
    {
        $question = new Question_Model();
        $question->id = 13;
        $question->hashtagsJSON = '["iPhone8", "Apple"]';

        $question = (new Question_Mapper('ru'))->updateHashtags($question);

        $this->assertEquals(13, $question->id);
        $this->assertEquals(2, count($question->getHashtags()));
    }

    public function test__EmptyArray()
    {
        $question = new Question_Model();
        $question->id = 13;
        $question->setHashtags([]);

        $question = (new Question_Mapper('ru'))->updateHashtags($question);

        $this->assertEquals(13, $question->id);
        $this->assertEquals(0, count($question->getHashtags()));
    }

    public function test__HashtagsNotSet()
    {
        $question = new Question_Model();
        $question->id = 13;

        $question = (new Question_Mapper('ru'))->updateHashtags($question);

        $this->assertEquals(13, $question->id);
        $this->assertEquals(0, count($question->getHashtags()));
    }
}
