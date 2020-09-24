<?php

namespace Test\Query\Subscriptions\findWithQuestionIDAndEmail;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['questions_subscriptions']];

    public function test__Basic_params()
    {
        $s = (new \Query\Subscriptions('ru'))->findWithQuestionIDAndEmail(236, 'data@test.ru');

        $this->assertEquals(2, $s->id);
        $this->assertEquals(236, $s->questionID);
        $this->assertEquals('data@test.ru', $s->email);
        $this->assertEquals('2016-05-06 09:48:24', $s->createdAt);
    }

    public function test__Subscription_not_found()
    {
        $s = (new \Query\Subscriptions('ru'))->findWithQuestionIDAndEmail(665, 'test@mail.ru');

        $this->assertEquals(null, $s);
    }
}
