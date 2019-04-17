<?php

class Validator_Hashtag__validateExists__BaseTest extends PHPUnit\Framework\TestCase
{
    public function test_EN_Ok()
    {
        $hashtag = new Hashtag_Model();
        $hashtag->setID(13);
        $hashtag->title = 'apple';

        $this->assertEquals(true, Hashtag_Validator::validateExists($hashtag));
    }

    public function test_RU_Ok()
    {
        $hashtag = new Hashtag_Model();
        $hashtag->setID(13);
        $hashtag->title = 'яблоко';

        $this->assertEquals(true, Hashtag_Validator::validateExists($hashtag));
    }

    public function test_OneLetterTitle_Ok()
    {
        $hashtag = new Hashtag_Model();
        $hashtag->setID(13);
        $hashtag->title = 'xy';

        $this->assertEquals(true, Hashtag_Validator::validateExists($hashtag));
    }
}
