<?php

class Validator_Answer__validate__params__textTest extends PHPUnit\Framework\TestCase
{
    public function test__Text_is_empty()
    {
        $answer = new \Model\Answer();
        $answer->id = 4;
        $answer->text = '';
        $answer->updatedAt = '2016-03-19 06:47:41';

        $this->expectExceptionMessage('Answer text param "" must have a length greater than 1');
        \Validator\Answer::validate($answer);
    }
}
