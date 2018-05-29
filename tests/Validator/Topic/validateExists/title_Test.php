<?php

class Validator_Topic_negative_title_Test extends PHPUnit\Framework\TestCase
{
    public function test_titleNotSet()
    {
        $topic = new Topic_Model();
        $topic->setID(13);

        $this->expectExceptionMessage('Topic title param null must be a string');
        $this->assertEquals(true, Topic_Validator::validateExists($topic));
    }

    public function test_titleIsEmpty()
    {
        $topic = new Topic_Model();
        $topic->setID(13);
        $topic->setTitle('');

        $this->expectExceptionMessage('Topic title param "" must have a length between 2 and 127');
        $this->assertEquals(true, Topic_Validator::validateExists($topic));
    }

    public function test_TitleTooLong()
    {
        $topic = new Topic_Model();
        $topic->setID(13);
        $topic->setTitle('title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title');

        $this->expectExceptionMessage('Topic title param "title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title" must have a length between 2 and 127');
        $this->assertEquals(true, Topic_Validator::validateExists($topic));
    }
}
