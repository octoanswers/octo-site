<?php

class Validator_Revision_BaseTest extends PHPUnit\Framework\TestCase
{
    public function test__ValidFullRevision()
    {
        $revision = new Revision_Model();
        $revision->setID(13);
        $revision->answerID = 11;
        $revision->opcodes = 'xyz';
        $revision->baseText = 'Ответ на вопрос про птиц.';
        $revision->comment = 'Rev comment';
        $revision->parentID = 2;
        $revision->userID = 14;
        $revision->createdAt = '2015-12-16 13:28:56';

        $this->assertEquals(true, Revision_Validator::validate($revision));
    }

    public function test__RevisionWithMinParams()
    {
        $revision = new Revision_Model();
        $revision->answerID = 11;
        $revision->opcodes = 'xyz';
        $revision->baseText = 'Ответ на вопрос про птиц.';
        $revision->userID = 14;

        $validator = new Revision_Validator();

        $this->assertEquals(null, $revision->getID());
        $this->assertEquals(11, $revision->answerID);
        $this->assertEquals('xyz', $revision->opcodes);
        $this->assertEquals('Ответ на вопрос про птиц.', $revision->baseText);
        $this->assertEquals(null, $revision->comment);
        $this->assertEquals(null, $revision->parentID);
        $this->assertEquals(14, $revision->userID);
        $this->assertEquals(null, $revision->createdAt);
    }
}
