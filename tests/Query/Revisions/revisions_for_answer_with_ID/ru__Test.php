<?php

class Query_Revisions__revisions_for_answer_with_ID__ruTest extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['revisions', 'questions']];

    public function test__Question_have_some_revisions()
    {
        $revisions = (new \Query\Revisions('ru'))->revisions_for_answer_with_ID(4);

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

    public function test_Question_dont_have_revisions()
    {
        $actualResponse = (new \Query\Revisions('ru'))->revisions_for_answer_with_ID(7);

        $this->assertEquals([], $actualResponse);
    }
}
