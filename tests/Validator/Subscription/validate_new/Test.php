<?php

class Validator_Subscription__validate_newTest extends PHPUnit\Framework\TestCase
{
    public function test__Full_params()
    {
        $s = new \Model\Subscription();
        $s->questionID = 9;
        $s->email = 'loz@ba.com';
        $s->createdAt = '2015-11-29 09:28:34';

        $this->assertEquals(true, Subscription_Validator::validate_new($s));
    }

    public function test__Min_params()
    {
        $s = new \Model\Subscription();
        $s->questionID = 9;
        $s->email = 'loz@ba.com';

        $this->assertEquals(true, Subscription_Validator::validate_new($s));
    }
}
