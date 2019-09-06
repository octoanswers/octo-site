<?php

class Validator_Question__validate_titleTest extends PHPUnit\Framework\TestCase
{
    public function test__Validate_RU_title()
    {
        $this->assertEquals(null, Question_Validator::validate_title('Как пятница?'));
    }

    public function test__Validate_EN_title()
    {
        $this->assertEquals(null, Question_Validator::validate_title('Как ты, Маша?'));
    }

    public function test__Title_without_question_mark()
    {
        $this->expectExceptionMessage('Question title param must end with a question mark');
        $this->assertEquals(null, Question_Validator::validate_title('Как ты, Маша'));
    }

    public function test__Title_begin_plus_sign()
    {
        $this->expectExceptionMessage('Question title param can not begin with a plus sign');
        $this->assertEquals(null, Question_Validator::validate_title('+Как ты?'));
    }
}
