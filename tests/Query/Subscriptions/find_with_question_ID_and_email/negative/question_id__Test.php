<?php

class Query_Subscriptions__find_with_question_ID_and_email__negative__question_idTest extends \Tests\DB\TestCase
{
    public function test__Question_ID_equal_zero()
    {
        $this->expectExceptionMessage('Question id param 0 must be greater than or equal to 1');
        $s = (new \Query\Subscriptions('ru'))->find_with_question_ID_and_email(0, 'test@mail.ru');
    }

    public function test__Question_ID_below_zero()
    {
        $this->expectExceptionMessage('Question id param -1 must be greater than or equal to 1');
        $s = (new \Query\Subscriptions('ru'))->find_with_question_ID_and_email(-1, 'test@mail.ru');
    }
}
