<?php

class Validator_Hashtag_negative_title_Test extends PHPUnit\Framework\TestCase
{
    public function test_titleNotSet()
    {
        $hashtag = new Hashtag();
        $hashtag->id = 13;

        $this->expectExceptionMessage('Hashtag title param null must be a string');
        $this->assertEquals(true, Hashtag_Validator::validateExists($hashtag));
    }

    public function test_titleIsEmpty()
    {
        $hashtag = new Hashtag();
        $hashtag->id = 13;
        $hashtag->title = '';

        $this->expectExceptionMessage('Hashtag title param "" must have a length between 2 and 127');
        $this->assertEquals(true, Hashtag_Validator::validateExists($hashtag));
    }

    public function test_TitleTooLong()
    {
        $hashtag = new Hashtag();
        $hashtag->id = 13;
        $hashtag->title = 'title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title';

        $this->expectExceptionMessage('Hashtag title param "title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title" must have a length between 2 and 127');
        $this->assertEquals(true, Hashtag_Validator::validateExists($hashtag));
    }
}
