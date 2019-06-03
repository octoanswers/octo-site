<?php

class Validator_Hashtag_validateNewTest extends PHPUnit\Framework\TestCase
{
    public function test_One_word_category()
    {
        $hashtag = new Hashtag();
        $hashtag->title = 'Apple';

        $this->assertEquals(true, Hashtag_Validator::validateNew($hashtag));
    }

    public function test_Two_word_category()
    {
        $hashtag = new Hashtag();
        $hashtag->title = 'iPhone 8';

        $this->assertEquals(true, Hashtag_Validator::validateNew($hashtag));
    }

    public function test_Category_with_underscore()
    {
        $hashtag = new Hashtag();
        $hashtag->title = 'my_hashtag';

        $this->assertEquals(true, Hashtag_Validator::validateNew($hashtag));
    }
}
