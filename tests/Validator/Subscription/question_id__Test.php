<?php

class Validator_Subscription__question_id__Test extends PHPUnit\Framework\TestCase
{
    public function test__QiestionIDEqualZero()
    {
        $s = new Subscription_Model();
        $s->id = 18;
        $s->questionID = 0;
        $s->email = 'loz@ba.com';

        $this->expectExceptionMessage('Subscription "questionID" property 0 must be greater than or equal to 1');
        Subscription_Validator::validateExists($s);
    }

    public function test__QiestionIDBelowZero()
    {
        $s = new Subscription_Model();
        $s->id = 18;
        $s->questionID = -1;
        $s->email = 'loz@ba.com';

        $this->expectExceptionMessage('Subscription "questionID" property -1 must be greater than or equal to 1');
        Subscription_Validator::validateExists($s);
    }
}
