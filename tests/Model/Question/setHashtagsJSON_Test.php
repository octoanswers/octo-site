<?php

class Question_Model__setHashtagsJSON__Test extends PHPUnit\Framework\TestCase
{
    public function test__Base()
    {
        $question = new Question_Model();
        $question->setHashtagsJSON('["iPhone 8","Apple"]');

        $this->assertEquals('["iPhone 8","Apple"]', $question->getHashtagsJSON());
        $this->assertEquals(["iPhone 8","Apple"], $question->getHashtags());
    }

    public function test__setHashtags__Empty()
    {
        $question = new Question_Model();
        $question->setHashtags([]);

        $this->assertEquals(null, $question->getHashtagsJSON());
        $this->assertEquals([], $question->getHashtags());
    }
    
    public function test__Empty()
    {
        $this->expectExceptionMessage('Hashtags JSON must be longer than 0 char');

        $question = new Question_Model();
        $question->setHashtagsJSON('');
    }
}
