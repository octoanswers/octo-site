<?php

class Model_Hashtag__initWithTitle__Test extends PHPUnit\Framework\TestCase
{
    public function test_ENTitle_ReturnObj()
    {
        $hashtag = Hashtag_Model::initWithTitle('common_questions');

        $this->assertEquals('common_questions', $hashtag->getTitle());
        $this->assertEquals(null, $hashtag->getID());
    }

    public function test__RUTitle_ReturnObj()
    {
        $hashtag = Hashtag_Model::initWithTitle('проливной_дождь');

        $this->assertEquals('проливной_дождь', $hashtag->getTitle());
        $this->assertEquals(null, $hashtag->getID());
    }
}
