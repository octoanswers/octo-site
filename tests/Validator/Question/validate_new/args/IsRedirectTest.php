<?php

namespace Test\Validator\Question\validateNew;

class IsRedirectTest extends \PHPUnit\Framework\TestCase
{
    public function test__IsRedirect_not_set()
    {
        $question = new \Model\Question();
        $question->title = 'How iPhone 8 are charged?';

        $this->assertEquals(false, $question->isRedirect);
        $this->assertEquals(true, \Validator\Question::validateNew($question));
    }
}
