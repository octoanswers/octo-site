<?php

namespace Test\Mapper\Question\update;

class TitleTest extends \Test\TestCase\DB
{
    public function test__Update_with_empty_title()
    {
        $question = new \Model\Question();
        $question->id = 2;
        $question->title = '';
        $question->isRedirect = true;

        $this->expectExceptionMessage('Question title param "" must have a length between 3 and 255');
        $question = (new \Mapper\Question('ru'))->update($question);
    }

    public function test__Update_with_too_short_title()
    {
        $question = new \Model\Question();
        $question->id = 2;
        $question->title = 'F';
        $question->isRedirect = true;

        $this->expectExceptionMessage('Question title param "F" must have a length between 3 and 255');
        $question = (new \Mapper\Question('ru'))->update($question);
    }

    public function test__Update_with_too_long_title()
    {
        $question = new \Model\Question();
        $question->id = 2;
        $question->title = 'Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... ';
        $question->isRedirect = true;

        $this->expectExceptionMessage('Question title param "Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... " must have a length between 3 and 255');
        $question = (new \Mapper\Question('ru'))->update($question);
    }
}
