<?php

class Subscription_findWithQuestionIDAndEmail__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions_subscriptions']];

    public function test__baseArgs()
    {
        $s = (new Subscriptions_Query('ru'))->findWithQuestionIDAndEmail(236, 'data@test.ru');

        $this->assertEquals(2, $s->id);
        $this->assertEquals(236, $s->questionID);
        $this->assertEquals('data@test.ru', $s->email);
        $this->assertEquals('2016-05-06 09:48:24', $s->createdAt);
    }

    public function test__SubscriptionNotFound()
    {
        $s = (new Subscriptions_Query('ru'))->findWithQuestionIDAndEmail(665, 'test@mail.ru');

        $this->assertEquals(null, $s);
    }
}
