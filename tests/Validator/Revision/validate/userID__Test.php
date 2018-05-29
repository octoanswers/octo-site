<?php

class Validator_Revision__userID__Test extends PHPUnit\Framework\TestCase
{
    public function test__UserIDEqualZero()
    {
        $revision = new Revision_Model();
        $revision->setAnswerID(11);
        $revision->setOpcodes('xyz');
        $revision->setBaseText('Ответ на вопрос про птиц.');
        $revision->setUserID(0);

        $this->expectExceptionMessage('Revision userID property 0 must be greater than or equal to 1');
        Revision_Validator::validate($revision);
    }

    public function test__UserIDBelowZero()
    {
        $revision = new Revision_Model();
        $revision->setAnswerID(11);
        $revision->setOpcodes('xyz');
        $revision->setBaseText('Ответ на вопрос про птиц.');
        $revision->setUserID(-1);

        $this->expectExceptionMessage('Revision userID property -1 must be greater than or equal to 1');
        Revision_Validator::validate($revision);
    }
}
