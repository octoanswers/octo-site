<?php

class Subscription_findWithQuestionIDAndEmail__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions_subscriptions']];

    public function test__baseArgs()
    {
        $s = (new Subscriptions_Query('ru'))->findWithQuestionIDAndEmail(236, 'data@test.ru');

        $this->assertEquals(2, $s->getID());
        $this->assertEquals(236, $s->getQuestionID());
        $this->assertEquals('data@test.ru', $s->getEmail());
        $this->assertEquals('2016-05-06 09:48:24', $s->getCreatedAt());
    }

    public function test__SubscriptionNotFound()
    {
        $s = (new Subscriptions_Query('ru'))->findWithQuestionIDAndEmail(665, 'test@mail.ru');

        $this->assertEquals(null, $s);
    }
}
