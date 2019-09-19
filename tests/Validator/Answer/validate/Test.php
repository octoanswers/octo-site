<?php

class Validator_Answer__validateTest extends PHPUnit\Framework\TestCase
{
    public function test__Full_params()
    {
        $answer = new \Model\Answer();
        $answer->id = 4;
        $answer->text = 'Answer written at 08:04';
        $answer->updatedAt = '2016-03-19 06:47:41';

        $this->assertEquals(true, \Validator\Answer::validate($answer));
    }

    public function test__Min_params()
    {
        $answer = new \Model\Answer();
        $answer->id = 214;
        $answer->text = 'Answer written at 08:04';

        $this->assertEquals(true, \Validator\Answer::validate($answer));
    }
}
