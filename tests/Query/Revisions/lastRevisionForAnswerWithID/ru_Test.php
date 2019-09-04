<?php

class Mapper_Revisions_last_revision_for_answer_with_ID_Base_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['revisions']];

    public function testRevisionExists()
    {
        $revision = (new Revisions_Query('ru'))->last_revision_for_answer_with_ID(4);

        $this->assertEquals(4, $revision->id);
        $this->assertEquals(4, $revision->answerID);
        $this->assertEquals('c000d35i68', $revision->opcodes);
        $this->assertEquals('Last answer for question 4.', $revision->baseText);
        $this->assertEquals('Some rev comment', $revision->comment);
        $this->assertEquals(3, $revision->parentID);
    }

    public function testRevisionNotExists()
    {
        $revision = (new Revisions_Query('ru'))->last_revision_for_answer_with_ID(17);

        $this->assertEquals(null, $revision);
    }
}
