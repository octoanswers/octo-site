<?php

class Validator_Subscription__validate_exists__negative__question_idTest extends PHPUnit\Framework\TestCase
{
    public function test__Question_ID_equal_zero()
    {
        $s = new \Model\Subscription();
        $s->id = 18;
        $s->questionID = 0;
        $s->email = 'loz@ba.com';

        $this->expectExceptionMessage('Subscription "questionID" property 0 must be greater than or equal to 1');
        \Validator\Subscription::validate_exists($s);
    }

    public function test__Question_ID_below_zero()
    {
        $s = new \Model\Subscription();
        $s->id = 18;
        $s->questionID = -1;
        $s->email = 'loz@ba.com';

        $this->expectExceptionMessage('Subscription "questionID" property -1 must be greater than or equal to 1');
        \Validator\Subscription::validate_exists($s);
    }
}
