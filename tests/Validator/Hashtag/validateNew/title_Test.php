<?php

class Validator_Hashtag_validateNew_title_Test extends PHPUnit\Framework\TestCase
{
    public function test_titleNotSet()
    {
        $hashtag = new Hashtag_Model();

        $this->expectExceptionMessage('Hashtag title param null must be a string');
        $this->assertEquals(true, Hashtag_Validator::validateNew($hashtag));
    }

    public function test_titleIsEmpty()
    {
        $hashtag = new Hashtag_Model();
        $hashtag->setTitle('');

        $this->expectExceptionMessage('Hashtag title param "" must have a length between 2 and 127');
        $this->assertEquals(true, Hashtag_Validator::validateNew($hashtag));
    }

    public function test_TitleTooLong()
    {
        $hashtag = new Hashtag_Model();
        $hashtag->setID(13);
        $hashtag->setTitle('title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title');

        $this->expectExceptionMessage('Hashtag title param "title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title" must have a length between 2 and 127');
        $this->assertEquals(true, Hashtag_Validator::validateExists($hashtag));
    }
}
