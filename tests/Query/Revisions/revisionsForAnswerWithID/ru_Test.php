<?php

class Query_Revisions_revisionsForAnswerWithID_BaseTest extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['revisions', 'questions']];

    public function testQuestionHaveSomeRevisions()
    {
        $revisions = (new Revisions_Query('ru'))->revisionsForAnswerWithID(4);

        $this->assertEquals(4, $revisions[0]->getID());
        $this->assertEquals(4, $revisions[0]->getAnswerID());
        $this->assertEquals('Last answer for question 4.', $revisions[0]->getBaseText());
        $this->assertEquals(3, $revisions[0]->getParentID());

        $this->assertEquals(3, $revisions[1]->getID());
        $this->assertEquals(4, $revisions[1]->getAnswerID());
        $this->assertEquals('Answer text.', $revisions[1]->getBaseText());
        $this->assertEquals(2, $revisions[1]->getParentID());

        $this->assertEquals(2, $revisions[2]->getID());
        $this->assertEquals(4, $revisions[2]->getAnswerID());
        $this->assertEquals('Answer text.', $revisions[2]->getBaseText());
        $this->assertEquals(null, $revisions[2]->getParentID());
    }

    public function testQuestionDontHaveRevisions()
    {
        $actualResponse = (new Revisions_Query('ru'))->revisionsForAnswerWithID(7);

        $this->assertEquals([], $actualResponse);
    }
}
