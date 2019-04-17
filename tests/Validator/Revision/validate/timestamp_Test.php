<?php

class Validator_Revision_NegativeTimestampID_Test extends PHPUnit\Framework\TestCase
{
    public function testWrongType()
    {
        $revision = new Revision_Model();
        $revision->setAnswerID(11);
        $revision->setOpcodes('xyz');
        $revision->setBaseText('Ответ на вопрос про птиц.');
        $revision->setUserID(14);
        $revision->createdAt = 1234;

        $this->expectExceptionMessage('Revision createdAt param 1234 must be a string');

        Revision_Validator::validate($revision);
    }
}
