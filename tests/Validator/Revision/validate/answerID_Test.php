<?php

class Validator_Revision_NegativeAnswerID_Test extends PHPUnit\Framework\TestCase
{
    public function test_normal()
    {
        $revision = new Revision_Model();
        $revision->setAnswerID(4);
        $revision->setOpcodes('xyz');
        $revision->setBaseText('Answer written at 11:39.');
        $revision->setUserID(14);

        Revision_Validator::validate($revision);

        $this->assertEquals(4, $revision->getAnswerID());
    }

    public function testAnswerIDEqualZero()
    {
        $revision = new Revision_Model();
        $revision->setAnswerID(0);
        $revision->setOpcodes('xyz');
        $revision->setBaseText('Answer written at 11:39.');
        $revision->setUserID(14);

        $this->expectExceptionMessage('Revision answerID param 0 must be greater than or equal to 1');
        Revision_Validator::validate($revision);
    }

    public function testIDBelowZero()
    {
        $revision = new Revision_Model();
        $revision->setAnswerID(-1);
        $revision->setOpcodes('xyz');
        $revision->setBaseText('Answer written at 11:38.');
        $revision->setUserID(14);

        $this->expectExceptionMessage('Revision answerID param -1 must be greater than or equal to 1');
        Revision_Validator::validate($revision);
    }
}
