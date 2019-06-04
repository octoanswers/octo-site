<?php

use PHPUnit\Framework\TestCase;

class Query_ER_CategoriesQuestions__findByCategoryIDAndQuestionID__question_id__Test extends TestCase
{
    public function test__QuestionIDEqualZero__ThrowException()
    {
        $this->expectExceptionMessage('CategoryToQuestion relation "questionID" property 0 must be greater than or equal to 1');
        $ERs = (new CategoriesToQuestions_Relations_Query('ru'))->findByCategoryIDAndQuestionID(1, 0);
    }

    public function test__QuestionIDBelowZero__ThrowException()
    {
        $this->expectExceptionMessage('CategoryToQuestion relation "questionID" property -1 must be greater than or equal to 1');
        $ERs = (new CategoriesToQuestions_Relations_Query('ru'))->findByCategoryIDAndQuestionID(1, -1);
    }
}
