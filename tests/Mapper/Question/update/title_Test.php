<?php

class Mapper_Question_update_title_Test extends Abstract_DB_TestCase
{
    public function test_UpdateWithEmptyTitle_throwException()
    {
        $question = new Question_Model();
        $question->setID(2);
        $question->setTitle('');
        $question->setRedirect(true);

        $this->expectExceptionMessage('Question title param "" must have a length between 3 and 255');
        $question = (new Question_Mapper('ru'))->update($question);
    }

    public function test_UpdateWithTooShortTitle_throwException()
    {
        $question = new Question_Model();
        $question->setID(2);
        $question->setTitle('F');
        $question->setRedirect(true);

        $this->expectExceptionMessage('Question title param "F" must have a length between 3 and 255');
        $question = (new Question_Mapper('ru'))->update($question);
    }

    public function test_UpdateWithTooLongTitle_throwException()
    {
        $question = new Question_Model();
        $question->setID(2);
        $question->setTitle('Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... ');
        $question->setRedirect(true);

        $this->expectExceptionMessage('Question title param "Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... " must have a length between 3 and 255');
        $question = (new Question_Mapper('ru'))->update($question);
    }
}
