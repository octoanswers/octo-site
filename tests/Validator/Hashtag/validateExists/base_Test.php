<?php

class Validator_Hashtag__validateExists__BaseTest extends PHPUnit\Framework\TestCase
{
    public function test_EN_Ok()
    {
        $hashtag = new Hashtag_Model();
        $hashtag->setID(13);
        $hashtag->setTitle('apple');

        $this->assertEquals(true, Hashtag_Validator::validateExists($hashtag));
    }

    public function test_RU_Ok()
    {
        $hashtag = new Hashtag_Model();
        $hashtag->setID(13);
        $hashtag->setTitle('яблоко');

        $this->assertEquals(true, Hashtag_Validator::validateExists($hashtag));
    }

    public function test_OneLetterTitle_Ok()
    {
        $hashtag = new Hashtag_Model();
        $hashtag->setID(13);
        $hashtag->setTitle('xy');

        $this->assertEquals(true, Hashtag_Validator::validateExists($hashtag));
    }
}
