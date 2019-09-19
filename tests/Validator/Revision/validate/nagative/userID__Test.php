<?php

class Validator_Revision__validate__negative__user_IDTest extends PHPUnit\Framework\TestCase
{
    public function test__User_ID_equal_zero()
    {
        $revision = new \Model\Revision();
        $revision->answerID = 11;
        $revision->opcodes = 'xyz';
        $revision->baseText = 'Ответ на вопрос про птиц.';
        $revision->userID = 0;

        $this->expectExceptionMessage('Revision userID property 0 must be greater than or equal to 1');
        \Validator\Revision::validate($revision);
    }

    public function test__User_ID_below_zero()
    {
        $revision = new \Model\Revision();
        $revision->answerID = 11;
        $revision->opcodes = 'xyz';
        $revision->baseText = 'Ответ на вопрос про птиц.';
        $revision->userID = -1;

        $this->expectExceptionMessage('Revision userID property -1 must be greater than or equal to 1');
        \Validator\Revision::validate($revision);
    }
}
