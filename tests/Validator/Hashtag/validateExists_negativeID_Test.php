<?php

class Validator_Hashtag_validateExists_negativeIDTest extends PHPUnit\Framework\TestCase
{
    public function test_Exception_when_hashtag_ID_equal_zero()
    {
        $hashtag = new Hashtag();
        $hashtag->id = 0;
        $hashtag->title = 'iphone8';

        $this->expectExceptionMessage('Hashtag id param 0 must be greater than or equal to 1');
        Hashtag_Validator::validateExists($hashtag);
    }

    public function test_Exception_when_hashtag_ID_below_zero()
    {
        $hashtag = new Hashtag();
        $hashtag->id = -1;
        $hashtag->title = 'iphone8';

        $this->expectExceptionMessage('Hashtag id param -1 must be greater than or equal to 1');
        Hashtag_Validator::validateExists($hashtag);
    }
}
