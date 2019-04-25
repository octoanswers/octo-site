<?php

class HashtagTest extends PHPUnit\Framework\TestCase
{
    public function testInitWithDatabaseState()
    {
        $hashtag = Hashtag::initWithDBState([
            'h_id' => 13,
            'h_title' => 'virtual',
            'h_words' => 'cpu',
        ]);

        $this->assertEquals(13, $hashtag->id);
        $this->assertEquals('virtual', $hashtag->title);
    }

    public function testInitWithDatabaseStateOnRussian()
    {
        $hashtag = Hashtag::initWithDBState([
            'h_id' => 231,
            'h_title' => 'медицинскиеуслуги',
            'h_words' => 'таблетка',
        ]);

        $this->assertEquals(231, $hashtag->id);
        $this->assertEquals('медицинскиеуслуги', $hashtag->title);
    }

    public function testInitWithEmptyState()
    {
        $this->expectExceptionMessage('Hashtag init with empty state');
        $hashtag = Hashtag::initWithDBState([]);
    }

    public function testInitWithTitle()
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
