<?php

class Mapper_Answer__update__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test_updateExists()
    {
        $answer = new Answer_Model();
        $answer->setID(4);
        $answer->setText('Answer written at 20:54');
        $answer->setUpdatedAt('2016-03-19 06:47:41');

        $answer = (new Answer_Mapper('ru'))->update($answer);

        $this->assertEquals(4, $answer->getID());
        $this->assertEquals('Answer written at 20:54', $answer->getText());
        $this->assertEquals('2016-03-19 06:47:41', $answer->getUpdatedAt());
    }
}
