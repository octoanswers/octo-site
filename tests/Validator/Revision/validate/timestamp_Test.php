<?php

class Validator_Revision_NegativeTimestampID_Test extends PHPUnit\Framework\TestCase
{
    public function testWrongType()
    {
        $revision = new Revision_Model();
        $revision->answerID = 11;
        $revision->opcodes = 'xyz';
        $revision->baseText = 'Ответ на вопрос про птиц.';
        $revision->userID = 14;
        $revision->createdAt = 1234;

        $this->expectExceptionMessage('Revision createdAt param 1234 must be a string');

        Revision_Validator::validate($revision);
    }
}
