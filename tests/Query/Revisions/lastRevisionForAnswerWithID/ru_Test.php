<?php

class Mapper_Revisions_lastRevisionForAnswerWithID_Base_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['revisions']];

    public function testRevisionExists()
    {
        $revision = (new Revisions_Query('ru'))->lastRevisionForAnswerWithID(4);

        $this->assertEquals(4, $revision->getID());
        $this->assertEquals(4, $revision->answerID);
        $this->assertEquals('c000d35i68', $revision->opcodes);
        $this->assertEquals('Last answer for question 4.', $revision->baseText);
        $this->assertEquals('Some rev comment', $revision->comment);
        $this->assertEquals(3, $revision->parentID);
    }

    public function testRevisionNotExists()
    {
        $revision = (new Revisions_Query('ru'))->lastRevisionForAnswerWithID(17);

        $this->assertEquals(null, $revision);
    }
}
