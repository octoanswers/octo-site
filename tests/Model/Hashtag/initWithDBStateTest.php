<?php

class Hashtag_initWithDBStateTest extends PHPUnit\Framework\TestCase
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
            'h_title' => 'Медицинские услуги',
            'h_words' => 'таблетка',
        ]);

        $this->assertEquals(231, $hashtag->id);
        $this->assertEquals('Медицинские услуги', $hashtag->title);
    }

    public function testInitWithEmptyState()
    {
        $this->expectExceptionMessage('Hashtag init with empty state');
        $hashtag = Hashtag::initWithDBState([]);
    }
}
