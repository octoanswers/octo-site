<?php

class Subscription_findWithQuestionIDAndEmail__question_id__Test extends Abstract_DB_TestCase
{
    public function test__QuestionIDEqualZero()
    {
        $this->expectExceptionMessage('Question id param 0 must be greater than or equal to 1');
        $s = (new Subscriptions_Query('ru'))->findWithQuestionIDAndEmail(0, 'test@mail.ru');
    }

    public function test__QuestionIDBelowZero()
    {
        $this->expectExceptionMessage('Question id param -1 must be greater than or equal to 1');
        $s = (new Subscriptions_Query('ru'))->findWithQuestionIDAndEmail(-1, 'test@mail.ru');
    }
}
