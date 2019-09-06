<?php

use PHPUnit\Framework\TestCase;

class Query_Relations_CategoriesToQuestions__find_by_category_ID_and_question_ID__question_IDTest extends TestCase
{
    public function test__Question_ID_equal_zero()
    {
        $this->expectExceptionMessage('CategoryToQuestion relation "questionID" property 0 must be greater than or equal to 1');
        $ERs = (new CategoriesToQuestions_Relations_Query('ru'))->find_by_category_ID_and_question_ID(1, 0);
    }

    public function test__Question_ID_below_zero()
    {
        $this->expectExceptionMessage('CategoryToQuestion relation "questionID" property -1 must be greater than or equal to 1');
        $ERs = (new CategoriesToQuestions_Relations_Query('ru'))->find_by_category_ID_and_question_ID(1, -1);
    }
}
