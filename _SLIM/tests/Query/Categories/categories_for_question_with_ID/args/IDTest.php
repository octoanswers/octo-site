<?php

namespace Test\Query\Categories\categoriesForQuestionWithID;

use PHPUnit\Framework\TestCase;

class IDTest extends TestCase
{
    public function test__Question_ID_equal_zero()
    {
        $this->expectExceptionMessage('Question id param 0 must be greater than or equal to 1');
        $question = (new \Query\Categories('ru'))->categoriesForQuestionWithID(0);
    }

    public function test__Question_ID_negative()
    {
        $this->expectExceptionMessage('Question id param -1 must be greater than or equal to 1');
        $question = (new \Query\Categories('ru'))->categoriesForQuestionWithID(-1);
    }
}
