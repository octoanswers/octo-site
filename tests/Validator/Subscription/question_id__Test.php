<?php

class Validator_Subscription__question_id__Test extends PHPUnit\Framework\TestCase
{
    public function test__QiestionIDEqualZero()
    {
        $s = new Subscription_Model();
        $s->setID(18);
        $s->setQuestionID(0);
        $s->setEmail('loz@ba.com');

        $this->expectExceptionMessage('Subscription "questionID" property 0 must be greater than or equal to 1');
        Subscription_Validator::validateExists($s);
    }

    public function test__QiestionIDBelowZero()
    {
        $s = new Subscription_Model();
        $s->setID(18);
        $s->setQuestionID(-1);
        $s->setEmail('loz@ba.com');

        $this->expectExceptionMessage('Subscription "questionID" property -1 must be greater than or equal to 1');
        Subscription_Validator::validateExists($s);
    }
}
