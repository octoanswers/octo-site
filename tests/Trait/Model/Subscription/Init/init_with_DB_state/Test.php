<?php

class Trait_Model_Subscription__init_with_DB_state__Test extends PHPUnit\Framework\TestCase
{
    public function test__FullParams()
    {
        $s = Subscription_Model::init_with_DB_state([
            's_id'          => 13,
            's_question_id' => 9,
            's_email'       => 'wer@sio.ru',
            's_created_at'  => '2015-11-29 09:28:34',
        ]);

        $this->assertEquals(13, $s->id);
        $this->assertEquals(9, $s->questionID);
        $this->assertEquals('wer@sio.ru', $s->email);
        $this->assertEquals('2015-11-29 09:28:34', $s->createdAt);
    }
}
