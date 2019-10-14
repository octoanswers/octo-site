<?php

namespace Test\Traits\Model\Answer\init_with_DB_state;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test__Full_params()
    {
        $answer = \Model\Answer::init_with_DB_state([
            'q_id'         => 13,
            'a_text'       => 'Answer written at 20:54',
            'a_updated_at' => '2016-03-19 06:47:41',
        ]);

        $this->assertEquals(13, $answer->id);
        $this->assertEquals('Answer written at 20:54', $answer->text);
        $this->assertEquals('2016-03-19 06:47:41', $answer->updatedAt);
    }
}
