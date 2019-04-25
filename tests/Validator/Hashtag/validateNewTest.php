<?php

class HashtagValidator_validateNewTest extends PHPUnit\Framework\TestCase
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

    public function test_Exception_when_title_not_set()
    {
        $hashtag = new Hashtag();

        $this->expectExceptionMessage('Hashtag title param null must be a string');
        $this->assertEquals(true, Hashtag_Validator::validateNew($hashtag));
    }

    public function test_Exception_when_title_is_empty()
    {
        $hashtag = new Hashtag();
        $hashtag->title = '';

        $this->expectExceptionMessage('Hashtag title param "" must have a length between 2 and 127');
        $this->assertEquals(true, Hashtag_Validator::validateNew($hashtag));
    }

    public function test_Exception_when_title_too_long()
    {
        $hashtag = new Hashtag();
        $hashtag->id = 13;
        $hashtag->title = 'title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title';

        $this->expectExceptionMessage('Hashtag title param "title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title" must have a length between 2 and 127');
        $this->assertEquals(true, Hashtag_Validator::validateExists($hashtag));
    }

    public function test_Exception_when_title_contains_whitespace()
    {
        $hashtag = Hashtag::initWithTitle('проливной дождь');

        $this->expectExceptionMessage('Hashtag title "проливной дождь" contains non-word-character');
        $this->assertEquals(true, Hashtag_Validator::validateNew($hashtag));
    }

    public function test_Exception_when_title_contains_dash()
    {
        $hashtag = Hashtag::initWithTitle('foo-bar');

        $this->expectExceptionMessage('Hashtag title "foo-bar" contains non-word-character');
        $this->assertEquals(true, Hashtag_Validator::validateNew($hashtag));
    }

    public function test_Exception_when_title_contains_non_word_character()
    {
        $hashtag = Hashtag::initWithTitle('hash%');

        $this->expectExceptionMessage('Hashtag title "hash%" contains non-word-character');
        $this->assertEquals(true, Hashtag_Validator::validateNew($hashtag));
    }
}
