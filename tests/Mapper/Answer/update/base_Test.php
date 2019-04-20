<?php

class Mapper_Answer__update__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test_updateExists()
    {
        $answer = new Answer_Model();
        $answer->id = 4;
        $answer->text = 'Answer written at 20:54';
        $answer->updatedAt = '2016-03-19 06:47:41';

        $answer = (new Answer_Mapper('ru'))->update($answer);

        $this->assertEquals(4, $answer->id);
        $this->assertEquals('Answer written at 20:54', $answer->text);
        $this->assertEquals('2016-03-19 06:47:41', $answer->updatedAt);
    }
}
