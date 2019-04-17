<?php

class Validator_Answer_validate_ID_Test extends PHPUnit\Framework\TestCase
{
    public function test_IDEqualZero()
    {
        $answer = new Answer_Model();
        $answer->setID(0);
        $answer->text = 'Answer written at 08:04';
        $answer->updatedAt = '2016-03-19 06:47:41';

        $this->expectExceptionMessage('Answer id param 0 must be greater than or equal to 1');
        $this->assertEquals(true, Answer_Validator::validate($answer));
    }

    public function test_IDBelowZero()
    {
        $answer = new Answer_Model();
        $answer->setID(-1);
        $answer->text = 'Answer written at 08:04';
        $answer->updatedAt = '2016-03-19 06:47:41';

        $this->expectExceptionMessage('Answer id param -1 must be greater than or equal to 1');
        $this->assertEquals(true, Answer_Validator::validate($answer));
    }
}
