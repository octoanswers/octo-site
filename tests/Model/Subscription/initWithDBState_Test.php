<?php

class Model_Subscription__initWithDBState__Test extends PHPUnit\Framework\TestCase
{
    public function test__FullParams()
    {
        $s = Subscription_Model::initWithDBState([
            's_id' => 13,
            's_question_id' => 9,
            's_email' => 'wer@sio.ru',
            's_created_at' => '2015-11-29 09:28:34'
        ]);

        $this->assertEquals(13, $s->getID());
        $this->assertEquals(9, $s->getQuestionID());
        $this->assertEquals('wer@sio.ru', $s->getEmail());
        $this->assertEquals('2015-11-29 09:28:34', $s->getCreatedAt());
    }
}
