<?php

class Mapper_Subscription__create__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions_subscriptions']];

    public function test__FullParams__OK()
    {
        $s = new Subscription_Model();
        $s->setQuestionID(9);
        $s->setEmail('losh@adka.ru');

        $s = (new Subscription_Mapper('ru'))->create($s);

        $this->assertEquals(5, $s->getID());
        $this->assertEquals(9, $s->getQuestionID());
        $this->assertEquals('losh@adka.ru', $s->getEmail());
    }
}
