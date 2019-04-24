<?php

class Model_Hashtag__initWithTitle__Test extends PHPUnit\Framework\TestCase
{
    public function test_ENTitle_ReturnObj()
    {
        $hashtag = Hashtag::initWithTitle('common_questions');

        $this->assertEquals('common_questions', $hashtag->title);
        $this->assertEquals(null, $hashtag->id);
    }

    public function test__RUTitle_ReturnObj()
    {
        $hashtag = Hashtag::initWithTitle('проливной_дождь');

        $this->assertEquals('проливной_дождь', $hashtag->title);
        $this->assertEquals(null, $hashtag->id);
    }
}
