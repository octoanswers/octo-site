<?php

class Validator_Question_negative_title_Test extends PHPUnit\Framework\TestCase
{
    public function test_titleNotSet()
    {
        $question = new Question_Model();
        $question->id = 13;
        $question->isRedirect = true;

        $this->expectExceptionMessage('Question title param null must be a string');
        $this->assertEquals(true, Question_Validator::validate_exists($question));
    }

    public function test_titleIsEmpty()
    {
        $question = new Question_Model();
        $question->id = 13;
        $question->title = '';
        $question->isRedirect = true;

        $this->expectExceptionMessage('Question title param "" must have a length between 3 and 255');
        $this->assertEquals(true, Question_Validator::validate_exists($question));
    }

    public function testCommentTooShort()
    {
        $question = new Question_Model();
        $question->id = 13;
        $question->title = 'x';
        $question->isRedirect = true;

        $this->expectExceptionMessage('Question title param "x" must have a length between 3 and 255');
        $this->assertEquals(true, Question_Validator::validate_exists($question));
    }

    public function testCommentTooLong()
    {
        $question = new Question_Model();
        $question->id = 13;
        $question->title = 'Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42.';
        $question->isRedirect = true;

        $this->expectExceptionMessage('Question title param "Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42." must have a length between 3 and 255');
        $this->assertEquals(true, Question_Validator::validate_exists($question));
    }
}
