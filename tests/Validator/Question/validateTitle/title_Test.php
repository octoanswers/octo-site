<?php

class Validator_Question_validateTitle_Test extends PHPUnit\Framework\TestCase
{
    public function test_RuTitle_OK()
    {
        $this->assertEquals(null, Question_Validator::validateTitle('Как пятница?'));
    }

    public function test_EnTitle_OK()
    {
        $this->assertEquals(null, Question_Validator::validateTitle('Как ты, Маша?'));
    }

    public function test_TitleWithoutQuestionMark_ThrowException()
    {
        $this->expectExceptionMessage('Question title param must end with a question mark');
        $this->assertEquals(null, Question_Validator::validateTitle('Как ты, Маша'));
    }

    public function test_TitleBeginPlusSign()
    {
        $this->expectExceptionMessage('Question title param can not begin with a plus sign');
        $this->assertEquals(null, Question_Validator::validateTitle('+Как ты?'));
    }
}
