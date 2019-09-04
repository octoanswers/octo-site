<?php

use PHPUnit\Framework\TestCase;

class Query_ER_CategoriesQuestions__find_by_category_title_and_question_ID__question_id__Test extends TestCase
{
    public function test__QuestionIDEqualZero__ThrowException()
    {
        $this->expectExceptionMessage('CategoryToQuestion relation "questionID" property 0 must be greater than or equal to 1');
        $ERs = (new CategoriesToQuestions_Relations_Query('ru'))->find_by_category_title_and_question_ID('tag', 0);
    }

    public function test__QuestionIDBelowZero__ThrowException()
    {
        $this->expectExceptionMessage('CategoryToQuestion relation "questionID" property -1 must be greater than or equal to 1');
        $ERs = (new CategoriesToQuestions_Relations_Query('ru'))->find_by_category_title_and_question_ID('tag', -1);
    }
}
