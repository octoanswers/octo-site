<?php

class Mapper_Question__update__id__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test_UpdateWithNotExistsID_ThrowException()
    {
        $question = new Question_Model();
        $question->id = 2215;
        $question->title = 'This is question?';
        $question->isRedirect = false;

        $this->expectExceptionMessage('Question with ID 2215 not exists');
        $question = (new Question_Mapper('ru'))->update($question);
    }

    public function test_UpdateWithIDEqualZero_ThrowException()
    {
        $question = new Question_Model();
        $question->id = 0;
        $question->title = 'This is question?';
        $question->isRedirect = false;

        $this->expectExceptionMessage('Question id param 0 must be greater than or equal to 1');
        $question = (new Question_Mapper('ru'))->update($question);
    }

    public function test_UpdateWithIDBelowZero_ThrowException()
    {
        $question = new Question_Model();
        $question->id = -1;
        $question->title = 'This is question?';
        $question->isRedirect = true;

        $this->expectExceptionMessage('Question id param -1 must be greater than or equal to 1');
        $question = (new Question_Mapper('ru'))->update($question);
    }
}
