<?php

class Validator_Hashtag_validateNew_BaseTest extends PHPUnit\Framework\TestCase
{
    public function test_ValidateNewHashtagWithFullParams_Ok()
    {
        $hashtag = new Hashtag();
        $hashtag->title = 'iPhone 8';

        $this->assertEquals(true, Hashtag_Validator::validateNew($hashtag));
    }
}
