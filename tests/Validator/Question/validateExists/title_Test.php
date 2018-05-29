<?php

class Validator_Question_negative_title_Test extends PHPUnit\Framework\TestCase
{
    public function test_titleNotSet()
    {
        $question = new Question_Model();
        $question->setID(13);
        $question->setRedirect(true);

        $this->expectExceptionMessage('Question title param null must be a string');
        $this->assertEquals(true, Question_Validator::validateExists($question));
    }

    public function test_titleIsEmpty()
    {
        $question = new Question_Model();
        $question->setID(13);
        $question->setTitle('');
        $question->setRedirect(true);

        $this->expectExceptionMessage('Question title param "" must have a length between 3 and 255');
        $this->assertEquals(true, Question_Validator::validateExists($question));
    }

    public function testCommentTooShort()
    {
        $question = new Question_Model();
        $question->setID(13);
        $question->setTitle('x');
        $question->setRedirect(true);

        $this->expectExceptionMessage('Question title param "x" must have a length between 3 and 255');
        $this->assertEquals(true, Question_Validator::validateExists($question));
    }

    public function testCommentTooLong()
    {
        $question = new Question_Model();
        $question->setID(13);
        $question->setTitle('Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42.');
        $question->setRedirect(true);

        $this->expectExceptionMessage('Question title param "Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42." must have a length between 3 and 255');
        $this->assertEquals(true, Question_Validator::validateExists($question));
    }
}
