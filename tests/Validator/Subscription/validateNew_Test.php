<?php

class Validator_Subscription__validateNew__Test extends PHPUnit\Framework\TestCase
{
    public function test__FullParams__OK()
    {
        $s = new Subscription_Model();
        $s->questionID = 9;
        $s->email = 'loz@ba.com';
        $s->createdAt = '2015-11-29 09:28:34';

        $this->assertEquals(true, Subscription_Validator::validateNew($s));
    }

    public function test__MinParams__OK()
    {
        $s = new Subscription_Model();
        $s->questionID = 9;
        $s->email = 'loz@ba.com';

        $this->assertEquals(true, Subscription_Validator::validateNew($s));
    }
}
