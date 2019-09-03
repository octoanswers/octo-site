<?php

use PHPUnit\Framework\TestCase;

class Query_Categories_categories_for_question_with_ID_negativeID_Test extends TestCase
{
    public function test_Question_ID_equal_zero()
    {
        $this->expectExceptionMessage('Question id param 0 must be greater than or equal to 1');
        $question = (new Categories_Query('ru'))->categories_for_question_with_ID(0);
    }

    public function test_Question_ID_negative()
    {
        $this->expectExceptionMessage('Question id param -1 must be greater than or equal to 1');
        $question = (new Categories_Query('ru'))->categories_for_question_with_ID(-1);
    }
}
