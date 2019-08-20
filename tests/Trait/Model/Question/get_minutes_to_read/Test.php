<?php

class Model__Question__get_minutes_to_read__Test extends PHPUnit\Framework\TestCase
{
    protected $question;

    public function setUp(): void
    {
        $this->question = new Question_Model;
        $this->question->answer = new Answer_Model();
    }

    public function tearDown(): void
    {
        $this->question = null;
    }

    public function test__zero_answers()
    {
        $this->question->answer->text = '';
        $this->assertEquals(0, $this->question->get_minutes_to_read());
    }

    public function test__1_answer()
    {
        $this->question->answer->text = 'Some Text';
        $this->assertEquals(1, $this->question->get_minutes_to_read());
    }

    public function test__2_answers()
    {
        $this->question->answer->text = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
        $this->assertEquals(2, $this->question->get_minutes_to_read());
    }
}
