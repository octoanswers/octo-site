<?php

class Model_Answer_initWithDBState_Test extends PHPUnit\Framework\TestCase
{
    public function test_FullParams()
    {
        $answer = Answer_Model::initWithDBState([
            'q_id'         => 13,
            'a_text'       => 'Answer written at 20:54',
            'a_updated_at' => '2016-03-19 06:47:41',
        ]);

        $this->assertEquals(13, $answer->id);
        $this->assertEquals('Answer written at 20:54', $answer->text);
        $this->assertEquals('2016-03-19 06:47:41', $answer->updatedAt);
    }
}
