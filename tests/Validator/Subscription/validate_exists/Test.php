<?php

namespace Test\Validator\Subscription\validate_exists;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test__Full_params()
    {
        $s = new \Model\Subscription();
        $s->id = 18;
        $s->questionID = 9;
        $s->email = 'loz@ba.com';
        $s->createdAt = '2015-11-29 09:28:34';

        $this->assertEquals(true, \Validator\Subscription::validate_exists($s));
    }

    public function test__Min_params()
    {
        $s = new \Model\Subscription();
        $s->id = 89;
        $s->questionID = 9;
        $s->email = 'loz@ba.com';

        $this->assertEquals(true, \Validator\Subscription::validate_exists($s));
    }
}
