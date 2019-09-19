<?php

class Validator_Answer__validate__params__IDTest extends PHPUnit\Framework\TestCase
{
    public function test__ID_equal_zero()
    {
        $answer = new \Model\Answer();
        $answer->id = 0;
        $answer->text = 'Answer written at 08:04';
        $answer->updatedAt = '2016-03-19 06:47:41';

        $this->expectExceptionMessage('Answer id param 0 must be greater than or equal to 1');
        $this->assertEquals(true, Answer_Validator::validate($answer));
    }

    public function test__ID_below_zero()
    {
        $answer = new \Model\Answer();
        $answer->id = -1;
        $answer->text = 'Answer written at 08:04';
        $answer->updatedAt = '2016-03-19 06:47:41';

        $this->expectExceptionMessage('Answer id param -1 must be greater than or equal to 1');
        $this->assertEquals(true, Answer_Validator::validate($answer));
    }
}
