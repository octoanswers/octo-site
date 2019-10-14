<?php

namespace Test\Mapper\Question\create;

class TitleTest extends \Test\TestCase\DB
{
    public function test__Create_with_empty_title()
    {
        $question = new \Model\Question();
        $question->title = '';
        $question->isRedirect = true;

        $this->expectExceptionMessage('Question title param "" must have a length between 3 and 255');
        $question = (new \Mapper\Question('ru'))->create($question);
    }

    public function test__Create_with_too_short_title()
    {
        $question = new \Model\Question();
        $question->title = 'F';
        $question->isRedirect = true;

        $this->expectExceptionMessage('Question title param "F" must have a length between 3 and 255');
        $question = (new \Mapper\Question('ru'))->create($question);
    }

    public function test__Create_with_too_long_title()
    {
        $question = new \Model\Question();
        $question->title = 'Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... ';
        $question->isRedirect = true;

        $this->expectExceptionMessage('Question title param "Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... Long title... " must have a length between 3 and 255');
        $question = (new \Mapper\Question('ru'))->create($question);
    }
}
