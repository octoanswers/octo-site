<?php

namespace Test\Query\Relations\CategoriesToQuestions\findByCategoryIDAndQuestionID;

use PHPUnit\Framework\TestCase;

class QuestionIDTest extends TestCase
{
    public function test__Question_ID_equal_zero()
    {
        $this->expectExceptionMessage('CategoryToQuestion relation "questionID" property 0 must be greater than or equal to 1');
        $ERs = (new \Query\Relations\CategoriesToQuestions('ru'))->findByCategoryIDAndQuestionID(1, 0);
    }

    public function test__Question_ID_below_zero()
    {
        $this->expectExceptionMessage('CategoryToQuestion relation "questionID" property -1 must be greater than or equal to 1');
        $ERs = (new \Query\Relations\CategoriesToQuestions('ru'))->findByCategoryIDAndQuestionID(1, -1);
    }
}
