<?php

class Validator_Hashtag_validate_id_Test extends PHPUnit\Framework\TestCase
{
    public function test_IDEqualZero()
    {
        $hashtag = new Hashtag_Model();
        $hashtag->setID(0);
        $hashtag->title = 'iphone8';

        $this->expectExceptionMessage('Hashtag id param 0 must be greater than or equal to 1');
        Hashtag_Validator::validateExists($hashtag);
    }

    public function testIDBelowZero()
    {
        $hashtag = new Hashtag_Model();
        $hashtag->setID(-1);
        $hashtag->title = 'iphone8';

        $this->expectExceptionMessage('Hashtag id param -1 must be greater than or equal to 1');
        Hashtag_Validator::validateExists($hashtag);
    }
}
