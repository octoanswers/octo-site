<?php

class Trait_Model_Question_URL__get_short_URLTest extends PHPUnit\Framework\TestCase
{
    public function test__Full_params_hort_URL()
    {
        $question = new \Model\Question();
        $question->id = 13;
        $question->title = "What is 'Touch ID' in iPhone?";

        $this->assertEquals('https://answeropedia.org/en/13', $question->get_short_URL('en'));
    }

    public function test__Min_param_short_URL()
    {
        $question = new \Model\Question();
        $question->id = 13;

        $this->assertEquals('https://answeropedia.org/en/13', $question->get_short_URL('en'));
    }
}
