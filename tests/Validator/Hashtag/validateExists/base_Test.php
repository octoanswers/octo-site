<?php

class Validator_Hashtag__validateExists__BaseTest extends PHPUnit\Framework\TestCase
{
    public function test_EN_Ok()
    {
        $topic = new Hashtag_Model();
        $topic->setID(13);
        $topic->setTitle('apple');

        $this->assertEquals(true, Topic_Validator::validateExists($topic));
    }

    public function test_RU_Ok()
    {
        $topic = new Hashtag_Model();
        $topic->setID(13);
        $topic->setTitle('яблоко');

        $this->assertEquals(true, Topic_Validator::validateExists($topic));
    }

    public function test_OneLetterTitle_Ok()
    {
        $topic = new Hashtag_Model();
        $topic->setID(13);
        $topic->setTitle('xy');

        $this->assertEquals(true, Topic_Validator::validateExists($topic));
    }
}
