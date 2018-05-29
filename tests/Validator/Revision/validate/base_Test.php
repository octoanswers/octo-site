<?php

class Validator_Revision_BaseTest extends PHPUnit\Framework\TestCase
{
    public function test__ValidFullRevision()
    {
        $revision = new Revision_Model();
        $revision->setID(13);
        $revision->setAnswerID(11);
        $revision->setOpcodes('xyz');
        $revision->setBaseText('Ответ на вопрос про птиц.');
        $revision->setComment('Rev comment');
        $revision->setParentID(2);
        $revision->setUserID(14);
        $revision->setCreatedAt('2015-12-16 13:28:56');

        $this->assertEquals(true, Revision_Validator::validate($revision));
    }

    public function test__RevisionWithMinParams()
    {
        $revision = new Revision_Model();
        $revision->setAnswerID(11);
        $revision->setOpcodes('xyz');
        $revision->setBaseText('Ответ на вопрос про птиц.');
        $revision->setUserID(14);

        $validator = new Revision_Validator();

        $this->assertEquals(null, $revision->getID());
        $this->assertEquals(11, $revision->getAnswerID());
        $this->assertEquals('xyz', $revision->getOpcodes());
        $this->assertEquals('Ответ на вопрос про птиц.', $revision->getBaseText());
        $this->assertEquals(null, $revision->getComment());
        $this->assertEquals(null, $revision->getParentID());
        $this->assertEquals(14, $revision->getUserID());
        $this->assertEquals(null, $revision->getCreatedAt());
    }
}
