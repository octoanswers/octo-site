<?php

use PHPUnit\Framework\TestCase;

class Query_Categories__categories_for_question_with_ID__negative__IDTest extends TestCase
{
    public function test__Question_ID_equal_zero()
    {
        $this->expectExceptionMessage('Question id param 0 must be greater than or equal to 1');
        $question = (new \Query\Categories('ru'))->categories_for_question_with_ID(0);
    }

    public function test__Question_ID_negative()
    {
        $this->expectExceptionMessage('Question id param -1 must be greater than or equal to 1');
        $question = (new \Query\Categories('ru'))->categories_for_question_with_ID(-1);
    }
}
