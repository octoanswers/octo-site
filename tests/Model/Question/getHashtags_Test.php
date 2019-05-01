<?php

class Question_Model_getHashtagsTest extends PHPUnit\Framework\TestCase
{
    public function test_Get_hashtags()
    {
        $question = new Question_Model();
        $question->hashtagsJSON = '["iPhone8","Apple"]';

        $hashtags = $question->getHashtags();

        $this->assertEquals(2, count($hashtags));
        $this->assertEquals("iPhone8", $hashtags[0]->title);
    }

    public function test_Get_hashtags_from_empty_hashtagsJSON()
    {
        $question = new Question_Model();
        $question->hashtagsJSON = '';

        $hashtags = $question->getHashtags();

        $this->assertEquals(0, count($hashtags));
    }
    
    public function test_Get_hashtags_from_NULL_hashtagsJSON()
    {
        $question = new Question_Model();

        $hashtags = $question->getHashtags();

        $this->assertEquals(0, count($hashtags));
    }
}
