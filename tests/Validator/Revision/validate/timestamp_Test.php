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
        $revision->setCreatedAt(1234);

        Revision_Validator::validate($revision);

        $this->assertEquals('1234', $revision->getCreatedAt());
    }
}
