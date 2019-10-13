<?php

class Mapper_Subscription__create__Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['questions_subscriptions']];

    public function test__FullParams__OK()
    {
        $s = new \Model\Subscription();
        $s->questionID = 9;
        $s->email = 'losh@adka.ru';

        $s = (new \Mapper\Subscription('ru'))->create($s);

        $this->assertEquals(5, $s->id);
        $this->assertEquals(9, $s->questionID);
        $this->assertEquals('losh@adka.ru', $s->email);
    }
}
