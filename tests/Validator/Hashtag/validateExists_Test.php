<?php

class Validator_Hashtag_validateExistsTest extends PHPUnit\Framework\TestCase
{
    public function test_One_word_category()
    {
        $hashtag = new Hashtag();
        $hashtag->id = 13;
        $hashtag->title = 'Apple';

        $this->assertEquals(true, Hashtag_Validator::validateExists($hashtag));
    }

    public function test_RU_word()
    {
        $hashtag = new Hashtag();
        $hashtag->id = 13;
        $hashtag->title = 'Яблоко';

        $this->assertEquals(true, Hashtag_Validator::validateExists($hashtag));
    }

    public function test_Shortest_title()
    {
        $hashtag = new Hashtag();
        $hashtag->id = 13;
        $hashtag->title = 'xy';

        $this->assertEquals(true, Hashtag_Validator::validateExists($hashtag));
    }
}
