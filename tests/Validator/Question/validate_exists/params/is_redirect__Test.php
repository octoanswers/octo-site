<?php

class Validator_Question__validate_exists__params__is_redirectTest extends PHPUnit\Framework\TestCase
{
    public function test__IsRedirect_not_set()
    {
        $question = new \Model\Question();
        $question->id = 13;
        $question->title = 'How iPhone 8 are charged?';

        $this->assertEquals(false, $question->isRedirect);
        $this->assertEquals(true, \Validator\Question::validate_exists($question));
    }
}
