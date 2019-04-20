<?php

class Mapper_Answer_update_id_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test_updateNotExistsID()
    {
        $answer = new Answer_Model();
        $answer->id = 2035;
        $answer->text = 'Answer written at 20:54';
        $answer->updatedAt = '2016-03-19 06:47:41';

        $this->expectExceptionMessage('Answer with ID 2035 not updated');
        $answer = (new Answer_Mapper('ru'))->update($answer);
    }

    public function test_equalZero()
    {
        $answer = new Answer_Model();
        $answer->id = 0;
        $answer->text = 'Answer written at 20:54';
        $answer->updatedAt = '2016-03-19 06:47:41';

        $this->expectExceptionMessage('Answer id param 0 must be greater than or equal to 1');
        $answer = (new Answer_Mapper('ru'))->update($answer);
    }

    public function test_belowZero()
    {
        $answer = new Answer_Model();
        $answer->id = -1;
        $answer->text = 'Answer written at 20:54';
        $answer->updatedAt = '2016-03-19 06:47:41';

        $this->expectExceptionMessage('Answer id param -1 must be greater than or equal to 1');
        $answer = (new Answer_Mapper('ru'))->update($answer);
    }
}
