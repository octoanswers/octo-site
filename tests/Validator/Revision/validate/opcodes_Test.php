<?php

class Validator_Revision__opcodes__Test extends PHPUnit\Framework\TestCase
{
    public function test__OpcodesEqualNull()
    {
        $revision = new Revision_Model();
        $revision->setAnswerID(11);
        $revision->setBaseText('Answer about thunderbird 14-16.');

        $this->expectExceptionMessage('Revision opcodes param null must be a string');
        Revision_Validator::validate($revision);
    }

    // public function test__OpcodesNotString()
    // {
    //     $revision = new Revision_Model();
    //     $revision->setAnswerID(11);
    //     $revision->setOpcodes(123);
    //     $revision->setBaseText('Answer about thunderbird 14-16.');
    //
    //     $this->expectExceptionMessage('Revision opcodes param "" must have a length greater than 2');
    //     Revision_Validator::validate($revision);
    // }

    public function test__OpcodesIsEmpty()
    {
        $revision = new Revision_Model();
        $revision->setAnswerID(11);
        $revision->setOpcodes('');
        $revision->setBaseText('Answer about thunderbird 14-16.');

        $this->expectExceptionMessage('Revision opcodes param "" must have a length greater than 2');
        Revision_Validator::validate($revision);
    }

    public function test__OpcodesTooShort()
    {
        $revision = new Revision_Model();
        $revision->setAnswerID(11);
        $revision->setOpcodes('x');
        $revision->setBaseText('Answer about thunderbird 14-16.');

        $this->expectExceptionMessage('Revision opcodes param "x" must have a length greater than 2');
        Revision_Validator::validate($revision);
    }
}
