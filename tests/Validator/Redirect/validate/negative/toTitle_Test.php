<?php

class Redirect_Validator_negative_toTitle_Test extends PHPUnit\Framework\TestCase
{
    public function test_titleNotSet()
    {
        $redirect = new Question_Redirect_Model();
        $redirect->fromID = 7;

        $this->expectExceptionMessage('Redirect "to_title" property null must be a string');
        $this->assertEquals(true, Question_Redirect_Validator::validate($redirect));
    }

    public function test_titleIsEmpty()
    {
        $redirect = new Question_Redirect_Model();
        $redirect->fromID = 7;
        $redirect->toTitle = '';

        $this->expectExceptionMessage('Redirect "to_title" property "" must have a length between 3 and 255');
        $this->assertEquals(true, Question_Redirect_Validator::validate($redirect));
    }

    public function testCommentTooShort()
    {
        $redirect = new Question_Redirect_Model();
        $redirect->fromID = 12;
        $redirect->toTitle = 'x?';

        $this->expectExceptionMessage('Redirect "to_title" property "x?" must have a length between 3 and 255');
        $this->assertEquals(true, Question_Redirect_Validator::validate($redirect));
    }

    public function testCommentTooLong()
    {
        $redirect = new Question_Redirect_Model();
        $redirect->fromID = 7;
        $redirect->toTitle = 'Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42.';

        $this->expectExceptionMessage('Redirect "to_title" property "Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42." must have a length between 3 and 255');
        $this->assertEquals(true, Question_Redirect_Validator::validate($redirect));
    }
}
