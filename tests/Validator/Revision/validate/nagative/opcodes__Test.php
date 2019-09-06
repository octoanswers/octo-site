<?php

class Validator_Revision__validate__negative__opcodesTest extends PHPUnit\Framework\TestCase
{
    public function test__Opcodes_equal_null()
    {
        $revision = new Revision_Model();
        $revision->answerID = 11;
        $revision->baseText = 'Answer about thunderbird 14-16.';

        $this->expectExceptionMessage('Revision opcodes param null must be a string');
        Revision_Validator::validate($revision);
    }

    public function test__Opcodes_is_empty()
    {
        $revision = new Revision_Model();
        $revision->answerID = 11;
        $revision->opcodes = '';
        $revision->baseText = 'Answer about thunderbird 14-16.';

        $this->expectExceptionMessage('Revision opcodes param "" must have a length greater than 2');
        Revision_Validator::validate($revision);
    }

    public function test__Opcodes_too_hort()
    {
        $revision = new Revision_Model();
        $revision->answerID = 11;
        $revision->opcodes = 'x';
        $revision->baseText = 'Answer about thunderbird 14-16.';

        $this->expectExceptionMessage('Revision opcodes param "x" must have a length greater than 2');
        Revision_Validator::validate($revision);
    }
}
