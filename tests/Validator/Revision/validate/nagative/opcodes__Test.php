<?php

class Validator_Revision__validate__negative__opcodesTest extends PHPUnit\Framework\TestCase
{
    public function test__Opcodes_equal_null()
    {
        $revision = new \Model\Revision();
        $revision->answerID = 11;
        $revision->baseText = 'Answer about thunderbird 14-16.';

        $this->expectExceptionMessage('Revision opcodes param null must be a string');
        \Validator\Revision::validate($revision);
    }

    public function test__Opcodes_is_empty()
    {
        $revision = new \Model\Revision();
        $revision->answerID = 11;
        $revision->opcodes = '';
        $revision->baseText = 'Answer about thunderbird 14-16.';

        $this->expectExceptionMessage('Revision opcodes param "" must have a length greater than 2');
        \Validator\Revision::validate($revision);
    }

    public function test__Opcodes_too_hort()
    {
        $revision = new \Model\Revision();
        $revision->answerID = 11;
        $revision->opcodes = 'x';
        $revision->baseText = 'Answer about thunderbird 14-16.';

        $this->expectExceptionMessage('Revision opcodes param "x" must have a length greater than 2');
        \Validator\Revision::validate($revision);
    }
}
