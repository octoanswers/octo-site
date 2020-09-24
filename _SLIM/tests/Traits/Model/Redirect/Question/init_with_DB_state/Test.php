<?php

namespace Test\Traits\Model\Redirect\Question\init_with_DB_state;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test__Base_params()
    {
        $redirect = \Model\Redirect\Question::initWithDBState([
            'rd_from'  => 13,
            'rd_title' => 'This is question?',
        ]);

        $this->assertEquals(13, $redirect->fromID);
        $this->assertEquals('This is question?', $redirect->toTitle);
    }
}
