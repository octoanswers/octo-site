<?php

class Validator_Revision_NegativeAnswerID_Test extends PHPUnit\Framework\TestCase
{
    public function test_normal()
    {
        $revision = new Revision_Model();
        $revision->answerID = 4;
        $revision->opcodes = 'xyz';
        $revision->baseText = 'Answer written at 11:39.';
        $revision->userID = 14;

        Revision_Validator::validate($revision);

        $this->assertEquals(4, $revision->answerID);
    }

    public function testAnswerIDEqualZero()
    {
        $revision = new Revision_Model();
        $revision->answerID = 0;
        $revision->opcodes = 'xyz';
        $revision->baseText = 'Answer written at 11:39.';
        $revision->userID = 14;

        $this->expectExceptionMessage('Revision answerID param 0 must be greater than or equal to 1');
        Revision_Validator::validate($revision);
    }

    public function testIDBelowZero()
    {
        $revision = new Revision_Model();
        $revision->answerID = -1;
        $revision->opcodes = 'xyz';
        $revision->baseText = 'Answer written at 11:38.';
        $revision->userID = 14;

        $this->expectExceptionMessage('Revision answerID param -1 must be greater than or equal to 1');
        Revision_Validator::validate($revision);
    }
}
