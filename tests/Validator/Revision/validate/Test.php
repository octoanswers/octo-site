<?php

class Validator_Revision__validateTest extends PHPUnit\Framework\TestCase
{
    public function test__Revision_with_full_params()
    {
        $revision = new Revision_Model();
        $revision->id = 13;
        $revision->answerID = 11;
        $revision->opcodes = 'xyz';
        $revision->baseText = 'Ответ на вопрос про птиц.';
        $revision->comment = 'Rev comment';
        $revision->parentID = 2;
        $revision->userID = 14;
        $revision->createdAt = '2015-12-16 13:28:56';

        $this->assertEquals(true, Revision_Validator::validate($revision));
    }

    public function test__Revision_with_min_params()
    {
        $revision = new Revision_Model();
        $revision->answerID = 11;
        $revision->opcodes = 'xyz';
        $revision->baseText = 'Ответ на вопрос про птиц.';
        $revision->userID = 14;

        $validator = new Revision_Validator();

        $this->assertEquals(null, $revision->id);
        $this->assertEquals(11, $revision->answerID);
        $this->assertEquals('xyz', $revision->opcodes);
        $this->assertEquals('Ответ на вопрос про птиц.', $revision->baseText);
        $this->assertEquals(null, $revision->comment);
        $this->assertEquals(null, $revision->parentID);
        $this->assertEquals(14, $revision->userID);
        $this->assertEquals(null, $revision->createdAt);
    }

    public function test__BaseTextEqualNull()
    {
        $revision = new Revision_Model();
        $revision->answerID = 11;
        $revision->opcodes = 'xyz';
        $revision->userID = 14;

        $this->assertEquals(true, Revision_Validator::validate($revision));
    }
}
