<?php

class Mapper_Answer_update_id_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test_updateNotExistsID()
    {
        $answer = new Answer_Model();
        $answer->setID(2035);
        $answer->setText('Answer written at 20:54');
        $answer->setUpdatedAt('2016-03-19 06:47:41');

        $this->expectExceptionMessage('Answer with ID 2035 not updated');
        $answer = (new Answer_Mapper('ru'))->update($answer);
    }

    public function test_equalZero()
    {
        $answer = new Answer_Model();
        $answer->setID(0);
        $answer->setText('Answer written at 20:54');
        $answer->setUpdatedAt('2016-03-19 06:47:41');

        $this->expectExceptionMessage('Answer id param 0 must be greater than or equal to 1');
        $answer = (new Answer_Mapper('ru'))->update($answer);
    }

    public function test_belowZero()
    {
        $answer = new Answer_Model();
        $answer->setID(-1);
        $answer->setText('Answer written at 20:54');
        $answer->setUpdatedAt('2016-03-19 06:47:41');

        $this->expectExceptionMessage('Answer id param -1 must be greater than or equal to 1');
        $answer = (new Answer_Mapper('ru'))->update($answer);
    }
}
