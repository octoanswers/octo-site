<?php

class Hashtag_initWithTitleTest extends PHPUnit\Framework\TestCase
{
    public function test_Init_with_title()
    {
        $hashtag = Hashtag::initWithTitle('common_questions');

        $this->assertEquals('common_questions', $hashtag->title);
        $this->assertEquals(null, $hashtag->id);
    }

    public function test_Init_with_title_on_Russian()
    {
        $hashtag = Hashtag::initWithTitle('проливной_дождь');

        $this->assertEquals('проливной_дождь', $hashtag->title);
        $this->assertEquals(null, $hashtag->id);
    }
}
