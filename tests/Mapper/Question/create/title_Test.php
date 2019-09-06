<?php

class Mapper_Question__create__title__Test extends Abstract_DB_TestCase
{
    public function test_CreateWithEmptyTitle_throwException()
    {
        $question = new Question_Model();
        $question->title = '';
        $question->isRedirect = true;

        $this->expectExceptionMessage('Question title param "" must have a length between 3 and 255');
        $question = (new Question_Mapper('ru'))->create($question);
    }

    public function test_CreateWithTooShortTitle_throwException()
    {
        $question = new Question_Model();
        $question->title = 'F';
        $question->isRedirect = true;

        $this->expectExceptionMessage('Question title param "F" must have a length between 3 and 255');
        $question = (new Question_Mapper('ru'))->create($question);
    }

    public function test_CreateWithTooLongTitle_throwException()
    {
        $question = new Question_Model();
        $question->title = 'Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... ';
        $question->isRedirect = true;

        $this->expectExceptionMessage('Question title param "Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... " must have a length between 3 and 255');
        $question = (new Question_Mapper('ru'))->create($question);
    }
}
