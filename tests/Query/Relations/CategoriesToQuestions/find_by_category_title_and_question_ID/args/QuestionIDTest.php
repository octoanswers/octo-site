<?php

namespace Test\Query\Relations\CategoriesToQuestions\find_by_category_title_and_question_ID;

use PHPUnit\Framework\TestCase;

class QuestionIDTest extends TestCase
{
    public function test__Question_ID_equal_zero()
    {
        $this->expectExceptionMessage('CategoryToQuestion relation "questionID" property 0 must be greater than or equal to 1');
        $ERs = (new \Query\Relations\CategoriesToQuestions('ru'))->find_by_category_title_and_question_ID('tag', 0);
    }

    public function test__Question_ID_below_zero()
    {
        $this->expectExceptionMessage('CategoryToQuestion relation "questionID" property -1 must be greater than or equal to 1');
        $ERs = (new \Query\Relations\CategoriesToQuestions('ru'))->find_by_category_title_and_question_ID('tag', -1);
    }
}
