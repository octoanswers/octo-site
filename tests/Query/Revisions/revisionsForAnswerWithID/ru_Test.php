<?php

class Query_Revisions_revisions_for_answer_with_ID_BaseTest extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['revisions', 'questions']];

    public function testQuestionHaveSomeRevisions()
    {
        $revisions = (new Revisions_Query('ru'))->revisions_for_answer_with_ID(4);

        $this->assertEquals(4, $revisions[0]->id);
        $this->assertEquals(4, $revisions[0]->answerID);
        $this->assertEquals('Last answer for question 4.', $revisions[0]->baseText);
        $this->assertEquals(3, $revisions[0]->parentID);

        $this->assertEquals(3, $revisions[1]->id);
        $this->assertEquals(4, $revisions[1]->answerID);
        $this->assertEquals('Answer text.', $revisions[1]->baseText);
        $this->assertEquals(2, $revisions[1]->parentID);

        $this->assertEquals(2, $revisions[2]->id);
        $this->assertEquals(4, $revisions[2]->answerID);
        $this->assertEquals('Answer text.', $revisions[2]->baseText);
        $this->assertEquals(null, $revisions[2]->parentID);
    }

    public function testQuestionDontHaveRevisions()
    {
        $actualResponse = (new Revisions_Query('ru'))->revisions_for_answer_with_ID(7);

        $this->assertEquals([], $actualResponse);
    }
}
