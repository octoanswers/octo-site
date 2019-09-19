<?php

class Mapper_Revisions__save__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['revisions']];

    public function testSaveNewRevisionWithFullParams()
    {
        $revision = new \Model\Revision();
        $revision->answerID = 11;
        $revision->opcodes = 'abc';
        $revision->baseText = 'Answer written at 14:22';
        $revision->comment = 'Rev comment';
        $revision->parentID = 4;
        $revision->userID = 54;

        $revision = (new \Mapper\Revision('ru'))->save($revision);

        $this->assertEquals(8, $revision->id);
        $this->assertEquals(11, $revision->answerID);
        $this->assertEquals('abc', $revision->opcodes);
        $this->assertEquals('Answer written at 14:22', $revision->baseText);
        $this->assertEquals('Rev comment', $revision->comment);
        $this->assertEquals(4, $revision->parentID);
        $this->assertEquals(54, $revision->userID);
    }

    public function testSaveNewRevisionWithMinParams()
    {
        $revision = new \Model\Revision();
        $revision->answerID = 11;
        $revision->opcodes = 'abc';
        $revision->baseText = 'Answer written at 14:25';
        $revision->userID = 54;

        $actualResponse = (new \Mapper\Revision('ru'))->save($revision);

        $this->assertEquals(8, $revision->id);
        $this->assertEquals(11, $revision->answerID);
        $this->assertEquals('abc', $revision->opcodes);
        $this->assertEquals('Answer written at 14:25', $revision->baseText);
        $this->assertEquals(54, $revision->userID);
    }

    public function testUpdateRevisionWithFullParams()
    {
        $revision = new \Model\Revision();
        $revision->id = 5;
        $revision->answerID = 11;
        $revision->opcodes = 'abc';
        $revision->baseText = 'Answer written at 19:33';
        $revision->comment = 'Rev comment';
        $revision->parentID = 4;
        $revision->userID = 54;

        $revision = (new \Mapper\Revision('ru'))->save($revision);

        $this->assertEquals(5, $revision->id);
        $this->assertEquals(11, $revision->answerID);
        $this->assertEquals('abc', $revision->opcodes);
        $this->assertEquals('Answer written at 19:33', $revision->baseText);
        $this->assertEquals('Rev comment', $revision->comment);
        $this->assertEquals(4, $revision->parentID);
        $this->assertEquals(54, $revision->userID);
    }

    public function testUpdateRevisionWithMinParams()
    {
        $revision = new \Model\Revision();
        $revision->id = 5;
        $revision->answerID = 11;
        $revision->opcodes = 'abc';
        $revision->baseText = 'Answer written at 14:25';
        $revision->userID = 54;

        $actualResponse = (new \Mapper\Revision('ru'))->save($revision);

        $this->assertEquals(5, $revision->id);
        $this->assertEquals(11, $revision->answerID);
        $this->assertEquals('abc', $revision->opcodes);
        $this->assertEquals('Answer written at 14:25', $revision->baseText);
        $this->assertEquals(54, $revision->userID);
    }
}
