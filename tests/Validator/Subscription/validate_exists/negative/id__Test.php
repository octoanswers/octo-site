<?php

class Validator_Subscription__validate_exists__negative__idTest extends PHPUnit\Framework\TestCase
{
    public function test__ID_equal_zero()
    {
        $s = new \Model\Subscription();
        $s->id = 0;
        $s->questionID = 10;
        $s->email = 'loz@ba.com';

        $this->expectExceptionMessage('Subscription "id" property 0 must be greater than or equal to 1');
        Subscription_Validator::validate_exists($s);
    }

    public function test__ID_below_zero()
    {
        $s = new \Model\Subscription();
        $s->id = -1;
        $s->questionID = 19;
        $s->email = 'loz@ba.com';

        $this->expectExceptionMessage('Subscription "id" property -1 must be greater than or equal to 1');
        Subscription_Validator::validate_exists($s);
    }
}
