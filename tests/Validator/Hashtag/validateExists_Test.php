<?php

class Validator_Hashtag_validateExistsTest extends PHPUnit\Framework\TestCase
{
    public function test_Validate_hashtag_with_EN_title()
    {
        $hashtag = new Hashtag();
        $hashtag->id = 13;
        $hashtag->title = 'apple';

        $this->assertEquals(true, Hashtag_Validator::validateExists($hashtag));
    }

    public function test_Validate_hashtag_with_RU_title()
    {
        $hashtag = new Hashtag();
        $hashtag->id = 13;
        $hashtag->title = 'яблоко';

        $this->assertEquals(true, Hashtag_Validator::validateExists($hashtag));
    }

    public function test_Validate_hashtag_with_shortest_title()
    {
        $hashtag = new Hashtag();
        $hashtag->id = 13;
        $hashtag->title = 'xy';

        $this->assertEquals(true, Hashtag_Validator::validateExists($hashtag));
    }
}
