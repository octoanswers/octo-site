<?php

namespace Test\Validator\Redirect\Question\validate;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test__Validate_exists_question_with_full_params()
    {
        $redirect = new \Model\Redirect\Question();
        $redirect->fromID = 12;
        $redirect->toTitle = 'How iPhone 8 are charged?';

        $this->assertEquals(true, \Validator\Redirect\Question::validate($redirect));
    }
}
