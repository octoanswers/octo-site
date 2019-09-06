<?php

class Validator_Question__validate_new__params__is_redirectTest extends PHPUnit\Framework\TestCase
{
    public function test__IsRedirect_not_set()
    {
        $question = new Question_Model();
        $question->title = 'How iPhone 8 are charged?';

        $this->assertEquals(false, $question->isRedirect);
        $this->assertEquals(true, Question_Validator::validate_new($question));
    }
}
