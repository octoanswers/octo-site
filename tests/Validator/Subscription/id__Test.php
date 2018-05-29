<?php

class Validator_Subscription__id__Test extends PHPUnit\Framework\TestCase
{
    public function test_IDEqualZero()
    {
        $s = new Subscription_Model();
        $s->setID(0);
        $s->setQuestionID(10);
        $s->setEmail('loz@ba.com');

        $this->expectExceptionMessage('Subscription "id" property 0 must be greater than or equal to 1');
        Subscription_Validator::validateExists($s);
    }

    public function test__IDBelowZero()
    {
        $s = new Subscription_Model();
        $s->setID(-1);
        $s->setQuestionID(19);
        $s->setEmail('loz@ba.com');

        $this->expectExceptionMessage('Subscription "id" property -1 must be greater than or equal to 1');
        Subscription_Validator::validateExists($s);
    }
}
