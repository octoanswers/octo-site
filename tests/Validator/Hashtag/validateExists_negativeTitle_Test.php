<?php

class Validator_Hashtag_validateExists_negativeTitleTest extends PHPUnit\Framework\TestCase
{
    public function test_Exception_when_hashtag_title_not_set()
    {
        $hashtag = new Hashtag();
        $hashtag->id = 13;

        $this->expectExceptionMessage('Hashtag title param null must be a string');
        $this->assertEquals(true, Hashtag_Validator::validateExists($hashtag));
    }

    public function test_Exception_when_hashtag_title_is_empty()
    {
        $hashtag = new Hashtag();
        $hashtag->id = 13;
        $hashtag->title = '';

        $this->expectExceptionMessage('Hashtag title param "" must have a length between 2 and 127');
        $this->assertEquals(true, Hashtag_Validator::validateExists($hashtag));
    }

    public function test_Exception_when_hashtag_title_too_short()
    {
        $hashtag = new Hashtag();
        $hashtag->id = 13;
        $hashtag->title = 'x';

        $this->expectExceptionMessage('Hashtag title param "x" must have a length between 2 and 127');
        $this->assertEquals(true, Hashtag_Validator::validateExists($hashtag));
    }

    public function test_Exception_when_hashtag_title_too_long()
    {
        $hashtag = new Hashtag();
        $hashtag->id = 13;
        $hashtag->title = 'title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title';

        $this->expectExceptionMessage('Hashtag title param "title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title" must have a length between 2 and 127');
        $this->assertEquals(true, Hashtag_Validator::validateExists($hashtag));
    }
}
