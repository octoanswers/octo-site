<?php

class Validator_Revision_NegativeComment_Test extends PHPUnit\Framework\TestCase
{
    public function testCommentIsEmpty()
    {
        $revision = new Revision_Model();
        $revision->answerID = 11;
        $revision->opcodes = 'xyz';
        $revision->baseText = 'Answer written at 11:41.';
        $revision->comment = '';

        $this->expectExceptionMessage('Revision comment param "" must have a length between 3 and 255');
        Revision_Validator::validate($revision);
    }

    public function testCommentTooShort()
    {
        $revision = new Revision_Model();
        $revision->answerID = 11;
        $revision->opcodes = 'xyz';
        $revision->baseText = 'Answer written at 11:41.';
        $revision->comment = 'xy';

        $this->expectExceptionMessage('Revision comment param "xy" must have a length between 3 and 255');
        Revision_Validator::validate($revision);
    }

    public function testCommentTooLong()
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
