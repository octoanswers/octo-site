<?php

class Validator_Revision__opcodes__Test extends PHPUnit\Framework\TestCase
{
    public function test__OpcodesEqualNull()
    {
        $revision = new Revision_Model();
        $revision->answerID = 11;
        $revision->baseText = 'Answer about thunderbird 14-16.';

        $this->expectExceptionMessage('Revision opcodes param null must be a string');
        Revision_Validator::validate($revision);
    }

    // public function test__OpcodesNotString()
    // {
    //     $revision = new Revision_Model();
    //     $revision->answerID = 11;
    //     $revision->opcodes = 123;
    //     $revision->baseText = 'Answer about thunderbird 14-16.';
    //
    //     $this->expectExceptionMessage('Revision opcodes param "" must have a length greater than 2');
    //     Revision_Validator::validate($revision);
    // }

    public function test__OpcodesIsEmpty()
    {
        $revision = new Revision_Model();
        $revision->answerID = 11;
        $revision->opcodes = '';
        $revision->baseText = 'Answer about thunderbird 14-16.';

        $this->expectExceptionMessage('Revision opcodes param "" must have a length greater than 2');
        Revision_Validator::validate($revision);
    }

    public function test__OpcodesTooShort()
    {
        $revision = new Revision_Model();
        $revision->answerID = 11;
        $revision->opcodes = 'x';
        $revision->baseText = 'Answer about thunderbird 14-16.';

        $this->expectExceptionMessage('Revision opcodes param "x" must have a length greater than 2');
        Revision_Validator::validate($revision);
    }
}
