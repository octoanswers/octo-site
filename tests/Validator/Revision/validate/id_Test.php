<?php

class Validator_Revision_validate_NegativeID_Test extends PHPUnit\Framework\TestCase
{
    public function testIDEqualZero()
    {
        $revision = new Revision_Model();
        $revision->setID(0);
        $revision->setAnswerID(11);
        $revision->setBaseText('Some answer.');

        $this->expectExceptionMessage('Revision id param 0 must be greater than or equal to 1');
        Revision_Validator::validate($revision);
    }

    public function testIDBelowZero()
    {
        $revision = new Revision_Model();
        $revision->setID(-1);
        $revision->setAnswerID(11);
        $revision->setBaseText('Answer written at 10:15.');

        $this->expectExceptionMessage('Revision id param -1 must be greater than or equal to 1');
        Revision_Validator::validate($revision);
    }
}
