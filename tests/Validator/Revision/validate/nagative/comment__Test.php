<?php

class Validator_Revision__validate__negative__commentTest extends PHPUnit\Framework\TestCase
{
    public function test__Comment_is_empty()
    {
        $revision = new Revision_Model();
        $revision->answerID = 11;
        $revision->opcodes = 'xyz';
        $revision->baseText = 'Answer written at 11:41.';
        $revision->comment = '';

        $this->expectExceptionMessage('Revision comment param "" must have a length between 3 and 255');
        Revision_Validator::validate($revision);
    }

    public function test__Comment_too_short()
    {
        $revision = new Revision_Model();
        $revision->answerID = 11;
        $revision->opcodes = 'xyz';
        $revision->baseText = 'Answer written at 11:41.';
        $revision->comment = 'xy';

        $this->expectExceptionMessage('Revision comment param "xy" must have a length between 3 and 255');
        Revision_Validator::validate($revision);
    }

    public function test__Comment_too_long()
    {
        $revision = new Revision_Model();
        $revision->answerID = 11;
        $revision->opcodes = 'xyz';
        $revision->baseText = 'Answer written at 11:41.';
        $revision->comment = 'Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment.';

        $this->expectExceptionMessage('Revision comment param "Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment. Comment." must have a length between 3 and 255');
        Revision_Validator::validate($revision);
    }
}
