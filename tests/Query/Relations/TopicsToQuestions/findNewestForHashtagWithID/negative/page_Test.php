<?php

use PHPUnit\Framework\TestCase;

class Query_ER_TopicsQuestions__findNewestFortopicWithID__page__Test extends TestCase
{
    public function test__PageEqualZero()
    {
        $this->expectExceptionMessage('Questions list page param 0 must be greater than or equal to 1');
        $ERs = (new TopicsToQuestions_Relations_Query('ru'))->findNewestFortopicWithID(13, 0);
    }

    public function test__PageBelowZero()
    {
        $this->expectExceptionMessage('Questions list page param -1 must be greater than or equal to 1');
        $ERs = (new TopicsToQuestions_Relations_Query('ru'))->findNewestFortopicWithID(13, -1);
    }

    public function test__PageGreaterThan9999()
    {
        $this->expectExceptionMessage('Questions list page param 10000 must be less than or equal to 9999');
        $ERs = (new TopicsToQuestions_Relations_Query('ru'))->findNewestFortopicWithID(13, 10000);
    }
}
