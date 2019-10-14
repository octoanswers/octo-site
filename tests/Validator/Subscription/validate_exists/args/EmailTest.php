<?php

namespace Test\Validator\Subscription\validate_exists;

class EmailTest extends \PHPUnit\Framework\TestCase
{
    public function test__Email_not_set()
    {
        $s = new \Model\Subscription();
        $s->id = 18;
        $s->questionID = 22;

        $this->expectExceptionMessage('Subscription "email" property null must be a string');
        \Validator\Subscription::validate_exists($s);
    }

    public function test__Incorrect_email()
    {
        $s = new \Model\Subscription();
        $s->id = 18;
        $s->questionID = 51;
        $s->email = 'loz_ba.com';

        $this->expectExceptionMessage('Subscription "email" property "loz_ba.com" must be valid email');
        \Validator\Subscription::validate_exists($s);
    }
}
