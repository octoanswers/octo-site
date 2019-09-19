<?php

class Mapper_Question__update__title__Test extends Abstract_DB_TestCase
{
    public function test_UpdateWithEmptyTitle_throwException()
    {
        $question = new \Model\Question();
        $question->id = 2;
        $question->title = '';
        $question->isRedirect = true;

        $this->expectExceptionMessage('Question title param "" must have a length between 3 and 255');
        $question = (new \Mapper\Question('ru'))->update($question);
    }

    public function test_UpdateWithTooShortTitle_throwException()
    {
        $question = new \Model\Question();
        $question->id = 2;
        $question->title = 'F';
        $question->isRedirect = true;

        $this->expectExceptionMessage('Question title param "F" must have a length between 3 and 255');
        $question = (new \Mapper\Question('ru'))->update($question);
    }

    public function test_UpdateWithTooLongTitle_throwException()
    {
        $question = new \Model\Question();
        $question->id = 2;
        $question->title = 'Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... ';
        $question->isRedirect = true;

        $this->expectExceptionMessage('Question title param "Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... " must have a length between 3 and 255');
        $question = (new \Mapper\Question('ru'))->update($question);
    }
}
