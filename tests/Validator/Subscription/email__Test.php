<?php

class Validator_Subscription__email__Test extends PHPUnit\Framework\TestCase
{
    public function test__EmailNotSet()
    {
        $s = new Subscription_Model();
        $s->setID(18);
        $s->setQuestionID(22);

        $this->expectExceptionMessage('Subscription "email" property null must be a string');
        Subscription_Validator::validateExists($s);
    }

    public function test__IncorrectEmail()
    {
        $s = new Subscription_Model();
        $s->setID(18);
        $s->setQuestionID(51);
        $s->setEmail('loz_ba.com');

        $this->expectExceptionMessage('Subscription "email" property "loz_ba.com" must be valid email');
        Subscription_Validator::validateExists($s);
    }
}
