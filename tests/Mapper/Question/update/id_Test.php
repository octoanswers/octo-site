<?php

class Mapper_Question_update_id_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test_UpdateWithNotExistsID_ThrowException()
    {
        $question = new Question_Model();
        $question->setID(2215);
        $question->setTitle('This is question?');
        $question->setRedirect(false);

        $this->expectExceptionMessage("Question with ID 2215 not exists");
        $question = (new Question_Mapper('ru'))->update($question);
    }

    public function test_UpdateWithIDEqualZero_ThrowException()
    {
        $question = new Question_Model();
        $question->setID(0);
        $question->setTitle('This is question?');
        $question->setRedirect(false);

        $this->expectExceptionMessage('Question id param 0 must be greater than or equal to 1');
        $question = (new Question_Mapper('ru'))->update($question);
    }

    public function test_UpdateWithIDBelowZero_ThrowException()
    {
        $question = new Question_Model();
        $question->setID(-1);
        $question->setTitle('This is question?');
        $question->setRedirect(true);

        $this->expectExceptionMessage('Question id param -1 must be greater than or equal to 1');
        $question = (new Question_Mapper('ru'))->update($question);
    }
}
