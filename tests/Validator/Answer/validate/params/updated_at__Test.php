<?php

class Validator_Answer__validate__params__updated_atTest extends PHPUnit\Framework\TestCase
{
    public function test__UpdatedAt_not_set()
    {
        $answer = new Answer_Model();
        $answer->id = 4;
        $answer->text = 'Answer written at 08:04';

        $this->assertEquals(true, Answer_Validator::validate($answer));
    }

    public function test_UpdatedAt_is_empty()
    {
        $answer = new Answer_Model();
        $answer->id = 4;
        $answer->text = 'Answer written at 08:04';
        $answer->updatedAt = '';

        $this->assertEquals(true, Answer_Validator::validate($answer));
        $this->assertEquals(null, $answer->updatedAt);
    }
}
