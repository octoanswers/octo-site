<?php

class Trait_Model_Question_URL__get_minutes_to_readTest extends PHPUnit\Framework\TestCase
{
    protected $question;

    public function setUp(): void
    {
        $this->question = new Question_Model();
        $this->question->answer = new Answer_Model();
    }

    public function tearDown(): void
    {
        $this->question = null;
    }

    public function test__Zero_minutes()
    {
        $this->question->answer->text = '';
        $this->assertEquals(0, $this->question->get_minutes_to_read());
    }

    public function test__One_minutes_to_read()
    {
        $this->question->answer->text = 'Some Text';
        $this->assertEquals(1, $this->question->get_minutes_to_read());
    }

    public function test__Two_minutes_to_read()
    {
        $this->question->answer->text = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
        $this->assertEquals(2, $this->question->get_minutes_to_read());
    }
}
