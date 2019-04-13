<?php

class Model_Hashtag__initWithTitle__Test extends PHPUnit\Framework\TestCase
{
    public function test_ENTitle_ReturnObj()
    {
        $topic = Topic_Model::initWithTitle('common_questions');

        $this->assertEquals('common_questions', $topic->getTitle());
        $this->assertEquals(null, $topic->getID());
    }

    public function test__RUTitle_ReturnObj()
    {
        $topic = Topic_Model::initWithTitle('проливной_дождь');

        $this->assertEquals('проливной_дождь', $topic->getTitle());
        $this->assertEquals(null, $topic->getID());
    }
}
