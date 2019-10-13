<?php

class Query_Subscriptions__find_with_question_ID_and_emailTest extends \Tests\DB\TestCase
{
    protected $setUpDB = ['ru' => ['questions_subscriptions']];

    public function test__Basic_params()
    {
        $s = (new \Query\Subscriptions('ru'))->find_with_question_ID_and_email(236, 'data@test.ru');

        $this->assertEquals(2, $s->id);
        $this->assertEquals(236, $s->questionID);
        $this->assertEquals('data@test.ru', $s->email);
        $this->assertEquals('2016-05-06 09:48:24', $s->createdAt);
    }

    public function test__Subscription_not_found()
    {
        $s = (new \Query\Subscriptions('ru'))->find_with_question_ID_and_email(665, 'test@mail.ru');

        $this->assertEquals(null, $s);
    }
}
