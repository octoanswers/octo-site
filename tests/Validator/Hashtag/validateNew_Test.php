<?php

class Validator_Hashtag_validateNewTest extends PHPUnit\Framework\TestCase
{
    public function testValidateNewHashtag()
    {
        $hashtag = new Hashtag();
        $hashtag->title = 'iPhone8';

        $this->assertEquals(true, Hashtag_Validator::validateNew($hashtag));
    }

    public function testValidateNewHashtagWithUnderscore()
    {
        $hashtag = new Hashtag();
        $hashtag->title = 'my_hashtag';

        $this->assertEquals(true, Hashtag_Validator::validateNew($hashtag));
    }
}
